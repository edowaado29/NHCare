<?php 

session_start();

if(isset($_SESSION['login'])){
    header('Location: dashboard.php');
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
</head>
<body>
    <div class="bg"></div>
</body>
</html>