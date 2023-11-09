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
</head>
<body>
    <h1>Lupa password</h1>
</body>
</html>