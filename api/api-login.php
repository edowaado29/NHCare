<?php

include "koneksi.php";

function loginUser($email, $password) {
    global $koneksi;

    if (!empty($email) && !empty($password)) {
        // Perbaikan keamanan: Menggunakan prepared statement
        $query = "SELECT * FROM tb_donatur WHERE email = ? AND password = ?";
        $stmt = mysqli_prepare($koneksi, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $email, $password);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $result = mysqli_stmt_num_rows($stmt);

            if ($result > 0) {
                $idDonatur = getDataDonaturByEmail($email); // Fungsi untuk mendapatkan ID donatur berdasarkan email
                return ["status" => "success", "id_donatur" => $idDonatur];
            } else {
                return ["status" => "failed", "message" => "Email atau password salah"];
            }
        } else {
            return ["status" => "failed", "message" => "Error in the prepared statement."];
        }

        mysqli_stmt_close($stmt);
    } else {
        return ["status" => "failed", "message" => "Isi semua data"];
    }
}

function getDataDonaturByEmail($email) {
    global $koneksi;

    // Query untuk mendapatkan ID donatur berdasarkan email
    $email = mysqli_real_escape_string($koneksi, $email);
    $query = "SELECT * FROM tb_donatur WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error in query: ' . mysqli_error($koneksi));
    }

    $row = mysqli_fetch_assoc($result);
    return $row;
}

// Ambil data dari parameter GET
$email = $_GET['email'];
$password = $_GET['password'];

// Panggil fungsi loginUser dengan data email dan password dari parameter GET
echo json_encode(loginUser($email, $password));
?>
