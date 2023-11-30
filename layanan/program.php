<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$email = $_SESSION['login'];
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
$rowProfile = mysqli_fetch_assoc($result);

$obj = new Functions();
$selectProgram = $obj->get_data("SELECT * FROM tb_program");

if (isset($_POST['hapus'])) {
    $id_program = $_POST['hapus'];
    $result = $obj->delete_data("DELETE FROM tb_program WHERE id_program = '$id_program'");
    if ($result) {
        $_SESSION['delete_success'] = true;
        header("Location: program.php");
    }
    exit();
}

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
                </div>
                <ul class="sub-menu">
                    <li><a class="link_name" href="../anak_asuh/anak_asuh.php">Anak Asuh</a></li>
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
            <h3>Program</h3>
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
                        <button type="button" onclick="window.location.href='create_program.php'" class="add-new" id="addProgram"><i class='bx bx-plus'></i> Tambah Data</button>
                    </div>
                </div>
                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Program</th>
                                <th>Judul Program</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            while($row = mysqli_fetch_assoc($selectProgram)) :
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $row['id_program']; ?></td>
                                <td><?php echo $row['judul']; ?></td>
                                <td>
                                    <form method="POST" action="">
                                        <button type="button" onclick="window.location.href='detail_program.php?id_program=<?php echo $row['id_program']; ?>'"><i class='bx bxs-show'></i></button>
                                        <button type="button" onclick="window.location.href='edit_program.php?id_program=<?php echo $row['id_program']; ?>'"><i class='bx bxs-edit'></i></button>
                                        <button type="submit" name="hapus" value="<?php echo $row['id_program']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?');"><i class='bx bxs-trash'></i>                                
                                    </form>
                                </td>
                            </tr>
                            <?php 
                            $no++;
                            endwhile;
                            ?>
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
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>

    <script type="text/javascript" src="../assets/js/sidebar.js"></script>
    <script type="text/javascript" src="../assets/js/table.js"></script>
    <script type="text/javascript" src="../assets/js/search.js"></script>
    <?php 
    if($_SESSION['insert_success'] == true){
        ?>
        <script>
            var errorMsg = "Data berhasil ditambahkan!";
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
        $_SESSION['insert_success'] = false;
    } elseif($_SESSION['update_success'] == true){
        ?>
        <script>
            var errorMsg = "Data berhasil diedit!";
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
        $_SESSION['update_success'] = false;
    } elseif($_SESSION['delete_success'] == true){
        ?>
        <script>
            var errorMsg = "Data berhasil dihapus!";
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
        $_SESSION['delete_success'] = false;
    }
    ?>

</body>
</html>