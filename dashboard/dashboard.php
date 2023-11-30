<?php 

require '../database/functions.php';
date_default_timezone_set('Asia/Jakarta');

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
$rowProfile = mysqli_fetch_assoc($result);

$currentDate = date('Y-m-d');
$currentMonth = date('Y-m');

$obj = new Functions();

$selectAcara = $obj->get_data("SELECT * FROM tb_acara WHERE tanggal_acara LIKE '%".$currentDate."%'");

$selectDonasi = $obj->get_data("SELECT SUM(gross_amount) AS total_donasi FROM tb_donasi WHERE settlement_time LIKE '%".$currentMonth."%'");
$rowDonasi = mysqli_fetch_assoc($selectDonasi);

$selectAnak = $obj->get_data("SELECT COUNT(*) AS row_count FROM tb_anakasuh WHERE status = 'Aktif'");
$rowAnak = mysqli_fetch_assoc($selectAnak);

$selectPegawai = $obj->get_data("SELECT COUNT(*) AS row_count FROM tb_pegawai WHERE status = 'Aktif'");
$rowPegawai = mysqli_fetch_assoc($selectPegawai);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <i><img src="../assets/img/nhcare-logo.png" alt="nhcare-logo"></i>
            <span class="logo_name">NHCare</span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="icon-link active">
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
    <section class="home-section" style="height: 125vh;">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <h3>Dashboard</h3>
        </div>
        <div class="card-container">
            <div class="card-wrapper">
                <div class="payment-card bg-donasi">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Donasi Bulan Ini</span>
                            <span class="amount-value">Rp. <?php echo $rowDonasi['total_donasi']; ?></span>
                        </div>
                        <i class="fas fa-dollar-sign icon icon-donasi"></i>
                    </div>
                </div>
                <div class="payment-card bg-anak">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Anak Asuh Aktif</span>
                            <span class="amount-value"><?php echo $rowAnak['row_count']; ?></span>
                        </div>
                        <i class="fas fa-child icon icon-anak"></i>
                    </div>
                </div>
                <div class="payment-card bg-pegawai">
                    <div class="card-header">
                        <div class="amount">
                            <span class="title">Total Pegawai Aktif</span>
                            <span class="amount-value"><?php echo $rowPegawai['row_count']; ?></span>
                        </div>
                        <i class="fas fa-users icon icon-pegawai"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-table">
            <div class="table-title">
                <h3>Jadwal Acara Hari Ini</h3>
            </div>
            <div class="table" style="height: 100px;">
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Acara</th>
                                <th>Tanggal acara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while($row = mysqli_fetch_assoc($selectAcara)) :
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['judul']; ?></td>
                                <td><?php echo $row['tanggal_acara']; ?></td>
                            </tr>
                            <?php
                            $no++;
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>

    <script type="text/javascript" src="../assets/js/sidebar.js"></script>

    <?php 
    if($_SESSION['login_success'] == true){
        ?>
        <script>
            var errorMsg = "Login berhasil!";
            $('.msg').text(errorMsg);
            $('.alert-success').removeClass("hide");
            $('.alert-success').addClass("show");
            $('.alert-success').addClass("showAlert");
            setTimeout(function(){
                $('.alert-success').removeClass("show");
                $('.alert-success').addClass("hide");
            }, 5000);
        </script>
        <?php
        $_SESSION['login_success'] = false;
    }
    ?>
</body>
</html>