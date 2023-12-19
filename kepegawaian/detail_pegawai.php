<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
$rowProfile = mysqli_fetch_assoc($result);

$id_pegawai = $_GET['id_pegawai'];
$obj = new Functions();
$selectPegawai = $obj->get_data("SELECT tb_pegawai.id_pegawai AS id, tb_pegawai.nbm AS nbm_pegawai, tb_pegawai.nama AS nama_pegawai, tb_pegawai.jenis_kelamin AS jk, tb_pegawai.tempat_lahir AS tpt_lahir, tb_pegawai.tanggal_lahir AS tgl_lahir, tb_pegawai.pendidikan_terakhir AS last_pend, tb_pegawai.status_kepegawaian AS status_kep, tb_pegawai.alamat AS alamat_pegawai, tb_pegawai.no_hp AS hp, tb_pegawai.email AS email_pegawai, tb_pegawai.tanggal_masuk AS tgl_masuk, tb_pegawai.tanggal_keluar AS tgl_keluar, tb_pegawai.img_kk AS kk, tb_pegawai.img_ktp AS ktp, tb_pegawai.status AS status_pegawai, tb_pegawai.img_pegawai AS img, tb_pegawai.id_jabatan AS id_jab, tb_jabatan_pegawai.nama_jabatan AS jabatan_pegawai FROM tb_pegawai JOIN tb_jabatan_pegawai ON tb_pegawai.id_jabatan = tb_jabatan_pegawai.id_jabatan WHERE tb_pegawai.id_pegawai = '$id_pegawai'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    <link rel="stylesheet" href="../asset/css/reset.css">
    <link rel="stylesheet" href="../asset/css/alert.css">
    <link rel="stylesheet" href="../asset/css/sidebar.css">
    <link rel="stylesheet" href="../asset/css/detail.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="icon" type="image/png" href="../asset/img/nhcare-logo-color.png">
</head>
<body>
<div class="sidebar">
        <div class="logo-details">
            <i><img src="../asset/img/nhcare-logo.png" alt="nhcare-logo"></i>
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
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <h3>Detail Pegawai</h3>
        </div>
        <div class="home-body">
            <div class="back-btn">
                <button type="button" onclick="window.location.href='pegawai.php'"  class="btn btn-danger">Kembali</button>
            </div>
            <div class="table"> 
                <div class="table-header">
                    <div class="table-section">
                        <table>
                            <caption>Data Pegawai</caption>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($selectPegawai)) :
                                ?>
                                    <tr>
                                        <th >ID Pegawai</th>
                                        <td><?php echo $row['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >NBM</th>
                                        <td><?php echo $row['nbm_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Nama Pegawai</th>
                                        <td><?php echo $row['nama_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Jenis Kelamin</th>
                                        <td><?php echo $row['jk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Tempat Lahir</th>
                                        <td><?php echo $row['tpt_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Tanggal Lahir</th>
                                        <td><?php echo $row['tgl_lahir']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Pendidikan Terakhir</th>
                                        <td><?php echo $row['last_pend']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Jabatan</th>
                                        <td><?php echo $row['jabatan_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Status Kepegawaian</th>
                                        <td><?php echo $row['status_kep']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Alamat</th>
                                        <td><?php echo $row['alamat_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Nomor Handphone</th>
                                        <td><?php echo $row['hp']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Email</th>
                                        <td><?php echo $row['email_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Tanggal Masuk</th>
                                        <td><?php echo $row['tgl_masuk']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Tanggal Keluar</th>
                                        <td><?php echo $row['tgl_keluar']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Foto Kartu Keluarga</th>
                                        <td>
                                            <?php
                                            $img_kk = base64_encode($row['kk']);
                                            $imgSrcKK = "data:image/*;base64," . $img_kk;
                                            ?>
                                            <img src="<?php echo $imgSrcKK; ?>" alt="Img KK">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th >Foto KTP</th>
                                        <td>
                                            <?php
                                            $img_ktp = base64_encode($row['ktp']);
                                            $imgSrcKTP = "data:image/*;base64," . $img_ktp;
                                            ?>
                                            <img src="<?php echo $imgSrcKTP; ?>" alt="Img KTP">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th >Status</th>
                                        <td ><?php echo $row['status_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <th >Foto Pegawai</th>
                                        <td>
                                            <?php
                                            $img = base64_encode($row['img']);
                                            $imgSrc = "data:image/*;base64," . $img;
                                            ?>
                                            <img src="<?php echo $imgSrc; ?>" alt="Img Profile">
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImg">
    </div>
   
    <script type="text/javascript" src="../asset/js/sidebar.js"></script>
    <script type="text/javascript" src="../asset/js/modal.js"></script>
</body>
</html>