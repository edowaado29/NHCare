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

$obj = new Functions();

if(isset($_POST['simpan'])){
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_hp = $_POST['no_hp'];

    if(empty($nama) || empty($email) || empty($password) || empty($no_hp)){
        $_SESSION['empty_form'] = true;
        header("Location: profile.php");
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $updateProfile = $obj->update_data("UPDATE tb_user SET nama='$nama', email='$email', password='$password', no_hp='$no_hp' WHERE id_user=$id_user");
            if($updateProfile){
                $_SESSION['update_success'] = true;
                header("Location: profile.php");
            }
        } else {
            $_SESSION['invalid_email'] = true;
            header("Location: profile.php");
        }
    }

    exit();
}

if(isset($_POST['upload'])){
    if(empty($_FILES['file']['tmp_name'])){
        $_SESSION['empty_form'] = true;
        header("Location: profile.php");
    } else {
        $id_user = $_POST['id_user'];
        $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
        $file_size = $_FILES['file']['size'];
        $max_file_size = 64 * 1024;
        if ($file_size > $max_file_size) {
            $_SESSION['big_size'] = true;
            header("Location: profile.php");
        } else {
            $updateProfile = $obj->update_data("UPDATE tb_user SET img_profile='$image' WHERE id_user=$id_user");
            if($updateProfile){
                $_SESSION['update_success'] = true;
                header("Location: profile.php");
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
    <title>Profile</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
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
            <h3>Profile</h3>
        </div>
        <div class="home-profile">
            <div class="card-photo">
                <div class="img-profile">
                    <?php
                    $img = base64_encode($rowProfile['img_profile']);
                    $imgSrc = "data:image/*;base64," . $img;
                    ?>
                    <img src="<?php echo $imgSrc; ?>" alt="Img Profile" id="imagePreview">
                    <div class="card-body" style="height: 100px;">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_user" value="<?php echo $rowProfile['id_user']; ?>">
                            <div>
                                <input type="file" id="image" name="file" onchange="previewImage(event)">
                            </div>
                            <div class="btn-container" style="margin-top: 40px;">
                                <button type="submit" name="upload" class="btn btn-success">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body" style="width: 60%;">
                <form action="" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo $rowProfile['id_user']; ?>">
                    <div>
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" value="<?php echo $rowProfile['nama']; ?>">
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $rowProfile['email']; ?>">
                    </div>
                    <label for="password">Password</label>
                    <div class="flex" style="display: flex;">
                        <input type="password" name="password" id="password" value="<?php echo $rowProfile['password']; ?>">
                        <i class='bx bx-show-alt' style="margin: 15px; font-size: 30px; cursor: pointer;" onclick="togglePassword()"></i>
                    </div>
                    <div>
                        <label for="no_hp">Nomor Handphone</label>
                        <input type="text" id="no_hp" name="no_hp" value="<?php echo $rowProfile['no_hp']; ?>">
                    </div>
                    <div class="btn-container" style="margin-top: 150px;">
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
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>

    <script type="text/javascript" src="../assets/js/sidebar.js"></script>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const image = document.getElementById('imagePreview');
            image.style.maxWidth = '70%';
            image.style.margin = '15%';
            image.style.marginTop = '60px';
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
        
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
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
    }
    ?>
</body>
</html>