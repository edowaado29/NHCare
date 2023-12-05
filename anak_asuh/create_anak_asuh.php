<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

date_default_timezone_set('Asia/Jakarta');
$dateNow = date('YmdHis');
$idset = "AH".$dateNow;

$email = $_SESSION['login'];
$id_user = $_SESSION['id_user'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
$rowProfile = mysqli_fetch_assoc($result);

$obj = new Functions();

if(isset($_POST['simpan'])){
    $nik = $_POST['nik'];
    $name = $_POST['name'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tpt_lahir = $_POST['tpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    $ket = $_POST['ket'];
    $asrama = $_POST['asrama'];
    $akta = $_POST['akta'];
    $kk = $_POST['kk'];
    $skko = $_POST['skko'];
    $nama_sekolah = $_POST['nama_sekolah'];
    $tingkat = $_POST['tingkat'];
    $kelas = $_POST['kelas'];
    $cabang = $_POST['cabang'];
    $deskripsi = $_POST['deskripsi'];
    $nama_ayah = $_POST['nama_ayah'];
    $nik_ayah = $_POST['nik_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $nik_ibu = $_POST['nik_ibu'];
    $nama_wali = $_POST['nama_wali'];
    $nik_wali = $_POST['nik_wali'];
    $status = $_POST['status'];

    if(empty($nik) || empty($name) || empty($jenis_kelamin) || empty($tpt_lahir) || empty($tgl_lahir) || empty($alamat) || empty($ket) || empty($asrama) || empty($_FILES['file']['tmp_name']) || empty($_FILES['img_akta']['tmp_name']) || empty($_FILES['img_kk']['tmp_name']) || empty($_FILES['img_skko']['tmp_name'])){
        $_SESSION['empty_form'] = true;
    } else {
        $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $img_akta = addslashes(file_get_contents($_FILES['img_akta']['tmp_name']));
        $img_kk = addslashes(file_get_contents($_FILES['img_kk']['tmp_name']));
        $img_skko = addslashes(file_get_contents($_FILES['img_skko']['tmp_name']));
        $file_size = $_FILES['file']['size'];
        $akta_size = $_FILES['img_akta']['size'];
        $kk_size = $_FILES['img_kk']['size'];
        $skko_size = $_FILES['img_skko']['size'];
        $max_file_size = 64 * 1024;

        if($file_size > $max_file_size || $akta_size > $max_file_size || $kk_size > $max_file_size || $skko_size > $max_file_size){
            $_SESSION['big_size'] = true;
        } else {
            $insertAnak = $obj->insert_data("INSERT INTO `tb_anakasuh`(`id_anakasuh`, `nik_anak`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `keterangan`, `asrama`, `no_akta`, `img_akta`, `no_kk`, `img_kk`, `no_skko`, `img_skko`, `status`, `img_anak`, `nama_sekolah`, `tingkat`, `kelas`, `cabang`, `deskripsi`, `nama_ayah`, `nik_ayah`, `nama_ibu`, `nik_ibu`, `nama_wali`, `nik_wali`) VALUES ('$idset', '$nik','$name','$jenis_kelamin','$tpt_lahir','$tgl_lahir','$alamat','$ket','$asrama','$akta','$img_akta','$kk','$img_kk','$skko','$img_skko','$status','$image','$nama_sekolah','$tingkat','$kelas','$cabang','$deskripsi','$nama_ayah','$nik_ayah','$nama_ibu','$nik_ibu','$nama_wali','$nik_wali')");
            if($insertAnak){
                $_SESSION['insert_success'] = true;
                header("Location: anak_asuh.php");
            }
        }

        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anak Asuh</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/layout_button.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="icon" type="image/png" href="../assets/img/nhcare-logo-color.png">
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i><img src="../assets/img/nhcare-logo.png" alt="nhcare-logo"></i>
            <span class="logo_name">NHCare</span>
        </div>
        <ul class="nav-links">
            <li>
            <div class="icon-link">
                    <a href="../dashboard/dashboard.php">
                        <i class='bx bx-grid-alt'></i>
                        <span class="link_name">Dashboard</span>
                    </a>
                </div>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="dashboard.php">Dashboard</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../kedonaturan/kedonaturan.php">
                        <i class='bx bx-group'></i>
                        <span class="link_name">Kedonaturan</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../kedonaturan/kedonaturan.php">Kedonaturan</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../kepegawaian/pegawai.php">
                        <i class='bx bx-briefcase-alt'></i>
                        <span class="link_name">Kepegawaian</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../kepegawaian/pegawai.php">Kepegawaian</a></li>
                    <li><a href="../kepegawaian/jabatan.php">Jabatan Pegawai</a></li>
                    <li><a href="../kepegawaian/pegawai.php">Pegawai</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link active">
                    <a href="../anak_asuh/anak_asuh.php">
                        <i class='bx bx-id-card'></i>
                        <span class="link_name">Anak Asuh</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../anak_asuh/anak_asuh.php">Anak Asuh</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../layanan/acara.php">
                        <i class='bx bx-user-voice'></i>
                        <span class="link_name">Layanan</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../layanan/acara.php">Layanan</a></li>
                    <li><a href="../layanan/acara.php">Acara</a></li>
                    <li><a href="../layanan/program.php">Program</a></li>
                    <li><a href="../layanan/pertanyaan_umum.php">Pertanyaan Umum</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../media/video.php">
                        <i class='bx bx-play'></i>
                        <span class="link_name">Media</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../media/video.php">Media</a></li>
                    <li><a href="../media/video.php">Video</a></li>
                    <li><a href="../media/website.php">Website</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../donasi/pemasukan.php">
                        <i class='bx bx-money' ></i>
                        <span class="link_name">Donasi</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../donasi/pemasukan.php">Donasi</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content" onclick="window.location.href='../profile/profile.php'">
                        <?php
                        $img = base64_encode($rowProfile['img_profile']);
                        $imgSrc = "data:image/*;base64," . $img;
                        ?>
                        <img src="<?php echo $imgSrc; ?>" alt="Img Profile">
                    </div>
                    <div class="name-job">
                        <div class="profile-name"><?php echo $rowProfile["nama"]; ?></div>
                        <div class="job">Administrator</div>
                    </div>
                    <a href="../auth/logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');"><i class='bx bx-log-out' ></i></a>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section" style="height: 320vh">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <h3>Tambah Anak Asuh</h3>
        </div>
            <div class= "home-body" style="height: 308vh;">
                <div class="card-body">
                    <form action="create_anak_asuh.php" method="POST" enctype="multipart/form-data">
                        <div>
                            <label for="nik">NIK Anak Asuh</label>
                            <input type="text" id="nik" name="nik">
                        </div>
                        <div>
                            <label for="name">Nama Anak Asuh</label>
                            <input type="text" id="name" name="name">
                        </div>
                        <div>
                            <label>Jenis Kelamin</label><br>
                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" checked>
                            <label for="laki-laki" style="font-weight: 500;">Laki-laki</label>
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" style="margin-left: 15px; margin-top: 10px;">
                            <label for="perempuan" style="font-weight: 500;">Perempuan</label>
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="tpt_lahir">Tempat Lahir</label>
                            <input type="text" id="tpt_lahir" name="tpt_lahir">
                        </div>
                        <div>
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir">
                        </div>
                        <div>
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="2"></textarea>
                        </div>
                        <div>
                            <label for="ket">Keterangan</label>
                            <select id="ket" name="ket">
                                <option value="Yatim">Yatim</option>
                                <option value="Yatim Piatu">Yatim Piatu</option>
                                <option value="Piatu">Piatu</option>
                                <option value="Dhuafa">Dhuafa</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label for="asrama">Asrama</label>
                            <select id="asrama" name="asrama">
                                <option value="Asrama">Asrama</option>
                                <option value="Non Asrama">Non Asrama</option>
                            </select>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="akta">No. Akta</label>
                                <input type="text" id="akta" name="akta">
                            </div>
                            <div>
                                <label for="img_akta">Foto Akta</label>
                                <input type="file" id="img_akta" name="img_akta">
                            </div>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="kk">No. Kartu Keluarga</label>
                                <input type="text" id="kk" name="kk">
                            </div>
                            <div>
                                <label for="img_kk">Foto Kartu Keluarga</label>
                                <input type="file" id="img_kk" name="img_kk">
                            </div>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="skko">No. Surat Keterangan Kematian Orangtua</label>
                                <input type="text" id="skko" name="skko">
                            </div>
                            <div>
                                <label for="img_skko">Foto Surat Keterangan Kematian Orangtua</label>
                                <input type="file" id="img_skko" name="img_skko">
                            </div>
                        </div>
                        <div>
                            <label for="nama_sekolah">Nama Sekolah</label>
                            <input type="text" id="nama_sekolah" name="nama_sekolah">
                        </div>
                        <div>
                            <label for="tingkat">Tingkat</label>
                            <select id="tingkat" name="tingkat">
                                <option value="TK">TK</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelas">Kelas</label>
                            <select id="kelas" name="kelas">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <div>
                            <label for="cabang">Cabang</label>
                            <select id="cabang" name="cabang">
                                <option value="Patrang">Patrang</option>
                                <option value="Arjasa">Arjasa</option>
                                <option value="Jelbuk">Jelbuk</option>
                                <option value="Kaliwates">Kaliwates</option>
                                <option value="Sumbersari">Sumbersari</option>
                            </select>
                        </div>
                        <div>
                            <label for="deskripsi">Deskripsi Anak Asuh</label>
                            <textarea id="deskripsi" name="deskripsi" rows="2"></textarea>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="nama_ayah">Nama Ayah Kandung</label>
                                <input type="text" id="nama_ayah" name="nama_ayah">
                            </div>
                            <div>
                                <label for="nik_ayah">NIK Ayah Kandung</label>
                                <input type="text" id="nik_ayah" name="nik_ayah">
                            </div>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="nama_ibu">Nama Ibu Kandung</label>
                                <input type="text" id="nama_ibu" name="nama_ibu">
                            </div>
                            <div>
                                <label for="nik_ibu">NIK Ibu Kandung</label>
                                <input type="text" id="nik_ibu" name="nik_ibu">
                            </div>
                        </div>
                        <div class="flex">
                            <div>
                                <label for="nama_wali">Nama Wali</label>
                                <input type="text" id="nama_wali" name="nama_wali">
                            </div>
                            <div>
                                <label for="nik_wali">NIK Wali</label>
                                <input type="text" id="nik_wali" name="nik_wali">
                            </div>
                        </div>
                        <div>
                            <label>Status</label><br>
                            <input type="radio" id="aktif" name="status" value="Aktif" checked>
                            <label for="aktif" style="font-weight: 500;">Aktif</label>
                            <input type="radio" id="tdkaktif" name="status" value="Tidak Aktif" style="margin-left: 15px; margin-top: 10px;">
                            <label for="tdkaktif" style="font-weight: 500;">Tidak Aktif</label>
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="image">Foto Anak Asuh</label>
                            <input type="file" id="image" name="file" onchange="previewImage(event)">
                            <img id="imagePreview">
                        </div>
                        <div class="btn-container">
                            <button type="button" onclick="window.location.href='anak_asuh.php'" class="btn btn-danger">Kembali</button>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <div class="alert-danger hide">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"></span>
    </div>

    <script type="text/javascript" src="../assets/js/sidebar.js"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const image = document.getElementById('imagePreview');
            image.style.maxWidth = '120px';
            image.style.marginTop = '5px';
            image.style.display = 'none';

            reader.onload = function() {
                if (reader.readyState === FileReader.DONE) {
                    image.src = reader.result;
                    image.style.display = 'block';
                }
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
    <?php 
    if($_SESSION['empty_form'] == true){
        ?>
        <script>
            var errorMsg = "Form tidak boleh kosong!";
            $('.msg').text(errorMsg);
            $('.alert-danger').removeClass("hide");
            $('.alert-danger').addClass("show");
            $('.alert-danger').addClass("showAlert");
            setTimeout(function(){
                $('.alert-danger').removeClass("show");
                $('.alert-danger').addClass("hide");
            }, 5000);
        </script>
        <?php
        $_SESSION['empty_form'] = false;
    } elseif($_SESSION['big_size'] == true){
        ?>
        <script>
            var errorMsg = "Ukuran file terlalu besar!";
            $('.msg').text(errorMsg);
            $('.alert-danger').removeClass("hide");
            $('.alert-danger').addClass("show");
            $('.alert-danger').addClass("showAlert");
            setTimeout(function(){
                $('.alert-danger').removeClass("show");
                $('.alert-danger').addClass("hide");
            }, 5000);
        </script>
        <?php
        $_SESSION['big_size'] = false;
    }
    ?>

</body>
</html>