<?php

include 'koneksi.php'; 
require 'PHPMailerAutoload.php';
require 'class.phpmailer.php';
require 'class.smtp.php';

if (isset($_POST['nama'], $_POST['no_hp'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];

    // Lakukan kueri untuk mencari email dan password
    $sql = "SELECT email, password FROM tb_donatur WHERE nama = ? AND no_hp = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ss", $nama, $no_hp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $password_from_db = $row["password"];

        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nhcoree@gmail.com'; // Ganti dengan email pengirim
        $mail->Password = 'jiez nhdj ehah fjjz'; // Ganti dengan password email pengirim atau app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;



        $mail->setFrom('nhcoree@gmail.com', 'Admin NH Care'); // Ganti dengan email pengirim dan nama pengirim
        $mail->addAddress($email); // Tambahkan email penerima

        $mail->Subject = 'Reset Password';
        $mail->Body = 'Password Anda adalah: ' . $password_from_db .' , silahkan cek profile jika ingin ubah katasandi anda'; // Perbaikan pada baris ini

        if (!$mail->send()) {
            echo 'Email gagal dikirim.';
            echo 'Kesalahan: ' . $mail->ErrorInfo;
        } else {
            echo 'Email telah berhasil dikirim!';
}
    } else {
        echo json_encode(array("success" => false, "message" => "User tidak ditemukan"));
    }
} else {
    echo json_encode(array("gagal" => false, "message" => "Data tidak diterima"));
}
?>
