<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$id_user = $_SESSION['id_user'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
$rowProfile = mysqli_fetch_assoc($result);

$id_pegawai = $_GET['id_pegawai'];

$obj = new Functions();
$selectPegawai = $obj->get_data("SELECT tb_pegawai.id_pegawai AS id, tb_pegawai.nbm AS nbm_pegawai, tb_pegawai.nama AS nama_pegawai, tb_pegawai.jenis_kelamin AS jk, tb_pegawai.tempat_lahir AS tpt_lahir, tb_pegawai.tanggal_lahir AS tgl_lahir, tb_pegawai.pendidikan_terakhir AS last_pend, tb_pegawai.status_kepegawaian AS status_kep, tb_pegawai.alamat AS alamat_pegawai, tb_pegawai.no_hp AS hp, tb_pegawai.email AS email_pegawai, tb_pegawai.tanggal_masuk AS tgl_masuk, tb_pegawai.tanggal_keluar AS tgl_keluar, tb_pegawai.img_kk AS kk, tb_pegawai.img_ktp AS ktp, tb_pegawai.status AS status_pegawai, tb_pegawai.img_pegawai AS img, tb_pegawai.id_jabatan AS id_jab, tb_jabatan_pegawai.nama_jabatan AS jabatan_pegawai FROM tb_pegawai JOIN tb_jabatan_pegawai ON tb_pegawai.id_jabatan = tb_jabatan_pegawai.id_jabatan WHERE tb_pegawai.id_pegawai = '$id_pegawai'");
$rowPegawai = mysqli_fetch_assoc($selectPegawai);

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $nbm = $_POST['nbm'];
    $name = $_POST['name'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tpt_lahir = $_POST['tpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $last_pend = $_POST['last_pend'];
    $jabatan = $_POST['jabatan'];
    $status_kep = $_POST['status_kep'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $status = $_POST['status'];

    if(empty($nbm) || empty($name) || empty($jenis_kelamin) || empty($tpt_lahir) || empty($tgl_lahir) || empty($last_pend) || empty($jabatan) || empty($status_kep) || empty($alamat) || empty($hp) || empty($tgl_masuk) || empty($status)){
        $_SESSION['empty_form'] = true;
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(empty($_FILES['img_kk']['tmp_name']) && empty($_FILES['img_ktp']['tmp_name']) && empty($_FILES['file']['tmp_name'])){
                $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', status='$status', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                if($updatePegawai){
                    $_SESSION['update_success'] = true;
                    header("Location: pegawai.php");
                }
            } elseif(empty($_FILES['img_ktp']['tmp_name']) && empty($_FILES['img']['tmp_name'])){
                $img_kk = addslashes(file_get_contents($_FILES['img_kk']['tmp_name']));
                $kk_size = $_FILES['img_kk']['size'];
                $max_file_size = 64 * 1024;
                if ($kk_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_kk='$img_kk', status='$status', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } elseif(empty($_FILES['img_kk']['tmp_name']) && empty($_FILES['file']['tmp_name'])){
                $img_ktp = addslashes(file_get_contents($_FILES['img_ktp']['tmp_name']));
                $ktp_size = $_FILES['img_ktp']['size'];
                $max_file_size = 64 * 1024;
                if ($ktp_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_ktp='$img_ktp', status='$status', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } elseif(empty($_FILES['img_kk']['tmp_name']) && empty($_FILES['img_ktp']['tmp_name'])){
                $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $file_size = $_FILES['file']['size'];
                $max_file_size = 64 * 1024;
                if ($file_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', status='$status', img_pegawai='$image', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } elseif(empty($_FILES['file']['tmp_name'])){
                $img_kk = addslashes(file_get_contents($_FILES['img_kk']['tmp_name']));
                $img_ktp = addslashes(file_get_contents($_FILES['img_ktp']['tmp_name']));
                $kk_size = $_FILES['img_kk']['size'];
                $ktp_size = $_FILES['img_ktp']['size'];
                $max_file_size = 64 * 1024;
                if ($kk_size > $max_file_size || $ktp_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_kk='$img_kk', img_ktp='$img_ktp', status='$status', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } elseif(empty($_FILES['img_kTP']['tmp_name'])){
                $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $img_kk = addslashes(file_get_contents($_FILES['img_kk']['tmp_name']));
                $file_size = $_FILES['file']['size'];
                $kk_size = $_FILES['img_kk']['size'];
                $max_file_size = 64 * 1024;
                if ($file_size > $max_file_size || $kk_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_kk='$img_kk', status='$status', img_pegawai='$image', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } elseif(empty($_FILES['img_kk']['tmp_name'])){
                $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $img_ktp = addslashes(file_get_contents($_FILES['img_ktp']['tmp_name']));
                $file_size = $_FILES['file']['size'];
                $ktp_size = $_FILES['img_ktp']['size'];
                $max_file_size = 64 * 1024;
                if ($file_size > $max_file_size || $ktp_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_ktp='$img_ktp', status='$status', img_pegawai='$image', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            } else {
                $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
                $img_kk = addslashes(file_get_contents($_FILES['img_kk']['tmp_name']));
                $img_ktp = addslashes(file_get_contents($_FILES['img_ktp']['tmp_name']));
                $file_size = $_FILES['file']['size'];
                $kk_size = $_FILES['img_kk']['size'];
                $ktp_size = $_FILES['img_ktp']['size'];
                $max_file_size = 64 * 1024;
                if ($file_size > $max_file_size || $kk_size > $max_file_size || $ktp_size > $max_file_size) {
                    $_SESSION['big_size'] = true;
                } else {
                    $updatePegawai = $obj->update_data("UPDATE tb_pegawai SET nbm='$nbm', nama='$name', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tpt_lahir', tanggal_lahir='$tgl_lahir', pendidikan_terakhir='$last_pend', status_kepegawaian='$status_kep', alamat='$alamat', no_hp='$hp', email='$email', tanggal_masuk='$tgl_masuk', tanggal_keluar='$tgl_keluar', img_kk='$img_kk', img_ktp='$img_ktp', status='$status', img_pegawai='$image', id_jabatan='$jabatan' WHERE id_pegawai='$id'");
                    if($updatePegawai){
                        $_SESSION['update_success'] = true;
                        header("Location: pegawai.php");
                    }
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pegawai</title>
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
                <div class="icon-link active">
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
                <div class="icon-link">
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
    <section class="home-section" style="height: 248vh">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <h3>Edit Pegawai</h3>
        </div>
            <div class= "home-body" style="height: 236vh;">
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $_GET['id_pegawai']; ?>">
                        <div>
                            <label for="nbm">NBM</label>
                            <input type="text" id="nbm" name="nbm" value="<?php echo $rowPegawai['nbm_pegawai']; ?>">
                        </div>
                        <div>
                            <label for="name">Nama Pegawai</label>
                            <input type="text" id="name" name="name" value="<?php echo $rowPegawai['nama_pegawai']; ?>">
                        </div>
                        <div>
                            <label>Jenis Kelamin</label><br>
                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki" <?php echo ($rowPegawai['jk'] == 'Laki-laki') ? 'checked' : ''; ?>>
                            <label for="laki-laki" style="font-weight: 500;">Laki-laki</label>
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?php echo ($rowPegawai['jk'] == 'Perempuan') ? 'checked' : ''; ?> style="margin-left: 15px; margin-top: 10px;">
                            <label for="perempuan" style="font-weight: 500;">Perempuan</label>
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="tpt_lahir">Tempat Lahir</label>
                            <input type="text" id="tpt_lahir" name="tpt_lahir" value="<?php echo $rowPegawai['tpt_lahir']; ?>">
                        </div>
                        <div>
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" id="tgl_lahir" name="tgl_lahir" value="<?php echo $rowPegawai['tgl_lahir']; ?>">
                        </div>
                        <div>
                            <label for="last_pend">Pendidikan Terakhir</label>
                            <select id="last_pend" name="last_pend">
                                <option value="SD" <?php echo ($rowPegawai['last_pend'] == 'SD') ? 'selected' : ''; ?>>SD</option>
                                <option value="SMP" <?php echo ($rowPegawai['last_pend'] == 'SMP') ? 'selected' : ''; ?>>SMP/Sederajat</option>
                                <option value="SMA" <?php echo ($rowPegawai['last_pend'] == 'SMA') ? 'selected' : ''; ?>>SMA/Sederajat</option>
                                <option value="S1" <?php echo ($rowPegawai['last_pend'] == 'S1') ? 'selected' : ''; ?>>S1</option>
                                <option value="S2" <?php echo ($rowPegawai['last_pend'] == 'S2') ? 'selected' : ''; ?>>S2</option>
                            </select>
                        </div>
                        <div>
                            <label for="jabatan">Jabatan</label>
                            <select id="jabatan" name="jabatan">
                                <?php 
                                $selectJabatan = $obj->get_data("SELECT * FROM tb_jabatan_pegawai");
                                while($row = mysqli_fetch_assoc($selectJabatan)) :
                                ?>
                                <option value="<?php echo $row['id_jabatan']; ?>" <?php echo ($rowPegawai['id_jab'] == $row['id_jabatan']) ? 'selected' : ''; ?>><?php echo $row['nama_jabatan']; ?></option>
                                <?php 
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div>
                            <label>Status Kepegawaian</label><br>
                            <input type="radio" id="tetap" name="status_kep" value="Pegawai Tetap" <?php echo ($rowPegawai['status_kep'] == 'Pegawai Tetap') ? 'checked' : ''; ?>>
                            <label for="tetap" style="font-weight: 500;">Pegawai Tetap</label>
                            <input type="radio" id="tdktetap" name="status_kep" value="Pegawai Tidak Tetap" <?php echo ($rowPegawai['status_kep'] == 'Pegawai Tidak Tetap') ? 'checked' : ''; ?> style="margin-left: 15px; margin-top: 10px;">
                            <label for="tdktetap" style="font-weight: 500;">Pegawai Tidak Tetap</label>
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="alamat">Alamat</label>
                            <textarea id="alamat" name="alamat" rows="2"><?php echo $rowPegawai['alamat_pegawai']; ?></textarea>
                        </div>
                        <div>
                            <label for="hp">Nomor Handphone</label>
                            <input type="text" id="hp" name="hp" value="<?php echo $rowPegawai['hp']; ?>">
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="<?php echo $rowPegawai['email_pegawai']; ?>">
                        </div>
                        <div>
                            <label for="tgl_masuk">Tanggal Masuk</label>
                            <input type="date" id="tgl_masuk" name="tgl_masuk" value="<?php echo $rowPegawai['tgl_masuk']; ?>">
                        </div>
                        <div>
                            <label for="tgl_keluar">Tanggal Keluar (Kosongi jika masih aktif)</label>
                            <input type="date" id="tgl_keluar" name="tgl_keluar" value="<?php echo $rowPegawai['tgl_keluar']; ?>">
                        </div>
                        <div class="flex">
                            <div>
                                <label for="img_kk">Foto Kartu Keluarga</label>
                                <input type="file" id="img_kk" name="img_kk">
                            </div>
                            <div>
                                <label for="img_ktp">Foto KTP</label>
                                <input type="file" id="img_ktp" name="img_ktp">
                            </div>
                        </div>
                        <div>
                            <label>Status</label><br>
                            <input type="radio" id="aktif" name="status" value="Aktif" <?php echo ($rowPegawai['status_pegawai'] == 'Aktif') ? 'checked' : ''; ?>>
                            <label for="aktif" style="font-weight: 500;">Aktif</label>
                            <input type="radio" id="tdkaktif" name="status" value="Tidak Aktif" <?php echo ($rowPegawai['status_pegawai'] == 'Tidak Aktif') ? 'checked' : ''; ?> style="margin-left: 15px; margin-top: 10px;">
                            <label for="tdkaktif" style="font-weight: 500;">Tidak Aktif</label>
                        </div>
                        <div style="margin-top: 15px;">
                            <label for="image">Foto Pegawai</label>
                            <?php
                            $img = base64_encode($rowPegawai['img']);
                            $imgSrc = "data:image/*;base64," . $img;
                            ?>
                            <input type="file" id="image" name="file" onchange="previewImage(event)">
                            <?php if (!empty($imgSrc)) : ?>
                                <img id="imagePreview" src="<?php echo $imgSrc; ?>" style="max-width: 120px; margin-top: 5px; display: block;">
                            <?php else : ?>
                                <p>No image available</p>
                            <?php endif; ?>
                        </div>
                        <div class="btn-container">
                            <button type="button" onclick="window.location.href='pegawai.php'" class="btn btn-danger">Kembali</button>
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
    } elseif($_SESSION['invalid_email'] == true){
        ?>
        <script>
            var errorMsg = "Email tidak valid!";
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
        $_SESSION['invalid_email'] = false;
    } 
    ?>

</body>
</html>