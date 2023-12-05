<?php
include "koneksi.php";

// Pastikan parameter id_donatur telah diset dan tidak kosong
if (isset($_GET['id_donatur'])) {
    $idDonatur = $_GET['id_donatur'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $idDonatur = mysqli_real_escape_string($koneksi, $idDonatur);
    
    $query = "SELECT order_id, nama_donatur, keterangan, doa, gross_amount, settlement_time FROM tb_donasi WHERE id_donatur = '$idDonatur'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die('Error in query: ' . mysqli_error($koneksi));
    }

    $historiDonasi = array();

    // Ambil semua baris hasil query
    while ($row = mysqli_fetch_assoc($result)) {
        $historiDonasi[] = $row;
    }

    // Tutup koneksi database
    mysqli_close($koneksi);

    echo json_encode($historiDonasi); // Menampilkan hasil dalam format JSON (opsional)
} else {
    echo "Parameter id_donatur tidak valid atau tidak diset.";
}
?>
