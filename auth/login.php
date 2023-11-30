<?php 

require '../database/functions.php';

session_start();

if(isset($_SESSION['login'])){
    header('Location: ../dashboard/dashboard.php');
}

$error = 0;
$_SESSION['password_success'] = false;

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        $error = 1;
    } else {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email'");
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                if($password == $row['password']){
                    $_SESSION['login'] = $email;
                    $_SESSION['id_user'] = $row['id_user'];
                    $_SESSION['login_success'] = true;
                    $_SESSION['logout_success'] = false;
                    $_SESSION['insert_success'] = false;
                    $_SESSION['update_success'] = false;
                    $_SESSION['delete_success'] = false;
                    $_SESSION['empty_form'] = false;
                    $_SESSION['big_size'] = false;
                    $_SESSION['invalid_email'] = false;
                    header("Location: ../dashboard/dashboard.php");
                } else {
                    $error = 4;
                }
            } else {
                $error = 3;
            }
        } else {
            $error = 2;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <div class="alert-danger hide">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"></span>
    </div>
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>
    <section>
        <div class="imgBox">
            <img src="../assets/img/bg-login.jpg">
        </div>
        <div class="contentBox">
            <div class="formBox">
                <h2>Halaman Login</h2>
                <form action="" method="POST">
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="text" name="email">
                    </div>
                    <div class="inputBox">
                        <span>Password</span>
                        <div class="flex" style="display: flex;">
                            <input type="password" name="password" id="password">
                            <i class='bx bx-show-alt' style="margin: 10px; font-size: 24px; cursor: pointer; position: absolute;" onclick="togglePassword()"></i>
                        </div>
                    </div>
                    <div class="remember">
                        <a href="forgot_password.php">Lupa password ?</a>
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Login" name="login">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
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
    if($_SESSION['logout_success'] == true){
        ?>
        <script>
            var errorMsg = "Logout berhasil!";
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
        $_SESSION['logout_success'] = false;
    } elseif($_SESSION['password_success'] == true){
        ?>
        <script>
            var errorMsg = "Password berhasil diubah!";
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
        $_SESSION['password_success'] = false;
    }
    
    if($error == 1){
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
    } elseif($error == 2){
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
    } elseif($error == 3){
        ?>
        <script>
            var errorMsg = "Email belum terdaftar!";
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
    } elseif($error == 4){
        ?>
        <script>
            var errorMsg = "Email atau password salah!";
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
    }
    ?>
</body>
</html>