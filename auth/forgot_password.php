<?php 

require '../database/functions.php';

session_start();

if(isset($_SESSION['login'])){
    header('Location: dashboard.php');
}

$obj = new Functions();
$_SESSION['success'] = false;
$_SESSION['error'] = false;

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    
    $selectEmail = $obj->get_data("SELECT * FROM tb_user WHERE email='$email'");
    $row = mysqli_fetch_assoc($selectEmail);
    if($row && $row['email'] == $email){
        $_SESSION['email'] = $email;
        $_SESSION['success'] = true;
        header("Location: confirm_otp.php");
    } else {
        $_SESSION['error'] = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="../assets/css/alert.css">
    <link rel="stylesheet" href="../assets/css/forgot_password.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="icon" type="image/png" href="../assets/img/nhcare-logo-color.png">
</head>
<body>
    <div class="bg">
        <div class="container">
            <div class="card">
                <h2>Lupa Password</h2>
                <p>Masukkan alamat email Anda untuk mereset password.</p>
                <form action="" method="POST" id="myform">
                    <div class="input-group">
                        <input type="text" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="otpverify" style="display: none;">
                        <div class="input-group">
                            <input type="text" id="otp_inp" placeholder="Kode OTP">
                        </div>
                    </div>
                    <div class="btn-check" id="btn-check" style="display: block;">
                        <button type="submit" name="submit" id="submit">Cek Email</button>
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
    <?php 
    if($_SESSION['error'] == true){
        ?>
        <script>
            var errorMsg = "Email anda tidak terdaftar!";
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
        $_SESSION['error'] = false;
    }
    ?>
</body>
</html>