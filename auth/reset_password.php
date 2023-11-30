<?php 

require '../database/functions.php';

session_start();

if(isset($_SESSION['login'])){
    header('Location: dashboard.php');
}

$obj = new Functions();
$email = $_SESSION['email'];
$_SESSION['password_success'] = false;
$_SESSION['not_match'] = false;
$_SESSION['empty_form'] = false;

if(isset($_POST['submit'])){
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    
    if(empty($password1) || empty($password2)){
        $_SESSION['empty_form'] = true;
    } else {
        if($password1 == $password2){
            $updatePassword = $obj->update_data("UPDATE tb_user SET password='$password1' WHERE email='$email'");
            if($updatePassword){
                $_SESSION['password_success'] = true;
                $email = $_SESSION['email'] = false;
                header("Location: login.php");
            }
        } else {
            $_SESSION['not_match'] = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/forgot_password.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
</head>
<body>
    <div class="bg">
        <div class="container">
            <div class="card">
                <h2>Ubah Password</h2>
                <p>Masukkan password baru untuk akun anda.</p>
                <form action="" method="POST" id="myform">
                    <div class="input-group">
                        <input type="password" id="password1" name="password1" placeholder="Password baru">
                        <i class='bx bx-show-alt' style="margin: 10px; font-size: 24px; cursor: pointer;" onclick="togglePassword1()"></i>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password2" name="password2" placeholder="Konfirmasi password">
                        <i class='bx bx-show-alt' style="margin: 10px; font-size: 24px; cursor: pointer;" onclick="togglePassword2()"></i>
                    </div>
                    <div class="btn-check" id="btn-check" style="display: block;">
                        <button type="submit" name="submit" id="submit">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="alert-danger hide">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"></span>
    </div>
    <script type="text/javascript" src="../assets/js/forgot_password.js"></script>
    <script>
        function togglePassword1() {
            var passwordField = document.getElementById("password1");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }

        function togglePassword2() {
            var passwordField = document.getElementById("password2");
            if (passwordField.type === "password") {
                passwordField.type = "text";
            } else {
                passwordField.type = "password";
            }
        }
    </script>
    <?php 
    if($_SESSION['not_match'] == true){
        ?>
        <script>
            var errorMsg = "Password tidak cocok!";
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
        $_SESSION['not_match'] = false;
    } elseif($_SESSION['empty_form'] == true){
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
    }
    ?>
</body>
</html>