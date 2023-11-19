<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");

$id_program = $_GET['id_program'];
$obj = new Functions();
$selectProgram = $obj->get_data("SELECT * FROM tb_program where id_program = '$id_program'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/layout_button.css">
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
                <div class="icon-link active">
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
                    <a href="../donasi/pemasukan.php">
                        <i class='bx bx-money' ></i>
                        <span class="link_name">Donasi</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../donasi/pemasukan.php">Donasi</a></li>
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
            <h3>Detail Program</h3>
        </div>
        <div class="home-body">
            <div class="table"> 
            <div class="table-header">

                    <div>
                        
                        <button type="button" onclick="window.location.href='program.php'"  class="btn btn-secondary">Kembali</button>
                    </div>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Program</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $counter = 1;
                            while ($row = mysqli_fetch_assoc($selectProgram)) :
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['deskripsi']; ?></td>
                                    <td>
                                        <?php
                                        // Tampilkan gambar jika ada
                                        if (!empty($row['img_program'])) {
                                            $imageData = $row['img_program'];
                                            $imagePath = '../layanan/upload_img/' . $imageData; // Path ke gambar

                                            if (file_exists($imagePath)) {
                                                $imageType = exif_imagetype($imagePath); // Dapatkan tipe gambar

                                                $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];

                                                if (in_array($imageType, $allowedTypes)) {
                                                    // Tampilkan gambar dengan tag <img>
                                                    echo "<img src='$imagePath' alt='Gambar'>";
                                                } else {
                                                    echo "Invalid image data";
                                                }
                                            } else {
                                                echo "Image not found";
                                            }
                                        } else {
                                            echo "No image available";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $counter++;
                            endwhile;
                            ?>
                        </tbody>
                    </table>
                 
                </div>
            </div>
        </div>
    </section>
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