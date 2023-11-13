<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengeluaran</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>
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
                <div class="icon-link">
                    <a href="../anak_asuh/anak_asuh.php">
                        <i class='bx bx-id-card'></i>
                        <span class="link_name">Anak Asuh</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../anak_asuh/anak_asuh.php">Anak Asuh</a></li>
                    <li><a href="../anak_asuh/wali.php">Wali</a></li>
                    <li><a href="../anak_asuh/anak_asuh.php">Anak Asuh</a></li>
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
                <div class="icon-link active">
                    <a href="../donasi/pemasukan.php">
                        <i class='bx bx-money' ></i>
                        <span class="link_name">Donasi</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../donasi/pemasukan.php">Donasi</a></li>
                    <li><a href="../donasi/paket.php">Paket Donasi</a></li>
                    <li><a href="../donasi/pemasukan.php">Pemasukan</a></li>
                    <li><a href="../donasi/pengeluaran.php">Pengeluaran</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="../laporan/laporan.php">
                        <i class='bx bxs-report' ></i>
                        <span class="link_name">Laporan</span>
                    </a>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../laporan/laporan.php">Laporan</a></li>
                </ul>
            </li>
            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="../assets/img/user-profile.jpeg" alt="user-profile">
                    </div>
                    <div class="name-job">
                        <?php while($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="profile-name"><?php echo $row["nama"]; ?></div>
                        <?php endwhile; ?>
                        <div class="job">Administrator</div>
                    </div>
                    <a href="../auth/logout.php"><i class='bx bx-log-out' ></i></a>
                </div>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <div class="home-content">
            <i class='bx bx-menu' ></i>
            <h3>Pengeluaran</h3>
        </div>
        <div class="home-body">
            <div class="table">
                <div class="table-header">
                    <div class="show">
                        <p>Show</p>
                        <select id="itemperpage">
                            <option value="10" selected>10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <p>Per Page</p>
                    </div>
                    <div>
                        <input type="text" id="search" placeholder="Cari...">
                        <button class="add-new"><i class='bx bx-plus'></i> Tambah Data</button>
                    </div>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>
                                    <button><i class='bx bx-show' ></i></button>
                                    <button><i class='bx bxs-edit'></i></button>
                                    <button><i class='bx bxs-trash' ></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bottom-field">
                <ul class="pagination">
                  <li class="prev"><a href="#" id="prev">&#139;</a></li>
                  <li class="next"><a href="#" id="next">&#155;</a></li>
                </ul>
            </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="../assets/js/sidebar.js"></script>
    <script type="text/javascript" src="../assets/js/table.js"></script>

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