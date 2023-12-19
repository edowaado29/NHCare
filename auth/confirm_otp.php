<?php 

require '../database/functions.php';

session_start();

if(isset($_SESSION['login'])){
    header('Location: dashboard.php');
}

$obj = new Functions();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi OTP</title>
    <link rel="stylesheet" href="../asset/css/reset.css">
    <link rel="stylesheet" href="../asset/css/alert.css">
    <link rel="stylesheet" href="../asset/css/forgot_password.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/a50eac9860.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link rel="icon" type="image/png" href="../asset/img/nhcare-logo-color.png">
</head>
<body>
    <div class="bg">
        <div class="container">
            <div class="card">
                <h2>Lupa Password</h2>
                <p>Masukkan alamat email dan kode OTP Anda untuk mereset password.</p>
                <form action="" method="POST" id="myform">
                    <div class="input-group">
                        <input type="text" id="email" name="email" placeholder="Email" value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email'];} ?>" readonly>
                    </div>
                    <div class="otpverify" style="display: none;">
                        <div class="input-group">
                            <input type="text" id="otp_inp" placeholder="Kode OTP">
                        </div>
                    </div>
                </form>
                <div class="btn-group" id="btn-group">
                    <button onclick="sendOTP()" class="btn" name="btn" id="btn">Kirim OTP</button>
                    <button class="ntb" id="otp-btn">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="alert-success hide">
        <span class="bx bxs-check-circle"></span>
        <span class="msg"></span>
    </div>
    <script>
        feather.replace();
    </script>
    <script type="text/javascript" src="../asset/js/forgot_password.js"></script>
    <?php 
    if($_SESSION['success'] == true){
        ?>
        <script>
            var errorMsg = "Email anda terdaftar!";
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
        $_SESSION['success'] = false;
    }
    ?>
</body>
</html>