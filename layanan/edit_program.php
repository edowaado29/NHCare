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

$id_program = $_GET['id_program'];

$obj = new Functions();
$selectProgram = $obj->get_data("SELECT * FROM tb_program WHERE id_program = $id_program");
$rowProgram = mysqli_fetch_assoc($selectProgram);

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    if(empty($judul) || empty($deskripsi)){
        $_SESSION['empty_form'] = true;
        header("Location: edit_program.php?id_program=$id");
    } else {
        if(!empty($_FILES['file']['tmp_name'])){
            $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            $file_size = $_FILES['file']['size'];
            $max_file_size = 64 * 1024;
            if ($file_size > $max_file_size) {
                $_SESSION['big_size'] = true;
                header("Location: edit_program.php?id_program=$id");
            } else {
                $updateProgram = $obj->update_data("UPDATE tb_program SET judul='$judul', deskripsi='$deskripsi', img_program='$image', id_user='$id_user' WHERE id_program=$id");
                if($updateProgram){
                    $_SESSION['update_success'] = true;
                    header("Location: program.php");
                }
            }
        } else {
            $updateProgram = $obj->update_data("UPDATE tb_program SET judul='$judul', deskripsi='$deskripsi', id_user='$id_user' WHERE id_program=$id");
            if($updateProgram){
                $_SESSION['update_success'] = true;
                header("Location: program.php");
            }
        }
    }

    exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/layout_button.css">
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
            <h3>Edit Program</h3>
        </div>
            <div class= "home-body">
                <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $_GET['id_program']; ?>">
                    <div class="mb-3">
                        <label for="name">Judul Program</label>
                        <input type="text" id="judul" name="judul" value="<?php echo $rowProgram['judul']; ?>">
                    </div>
                        <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="5"><?php echo $rowProgram['deskripsi']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image">Gambar Program</label>
                        <?php
                        $img = base64_encode($rowProgram['img_program']);
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
                    <button type="button" onclick="window.location.href='program.php'" class="btn btn-danger">Kembali</button>
                        <button type="submit" name="simpan" class="btn btn-success">Edit</button>
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