<?php 

require '../database/functions.php';

session_start();

if(!isset($_SESSION['login'])){
    header('Location: ../auth/login.php');
}

$obj = new Functions();
$output = '';
$no = 1;

if(isset($_POST['excel'])){
    $selectAnak = $obj->get_data("SELECT * FROM tb_anakasuh");
    if($selectAnak){
        $output .= '
            <table class="table" border="1">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>NIK Anak</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Keterangan</th>
                    <th>Asrama</th>
                    <th>Nomor Akta</th>
                    <th>Nomor Kartu Keluarga</th>
                    <th>Nomor Surat Keterangan Kematian Orangtua</th>
                    <th>Status</th>
                    <th>Nama Sekolah</th>
                    <th>Tingkat</th>
                    <th>Kelas</th>
                    <th>Cabang</th>
                    <th>Deskripsi</th>
                    <th>NIK Ayah Kandung</th>
                    <th>Nama Ayah Kandung</th>
                    <th>NIK Ibu Kandung</th>
                    <th>Nama Ibu Kandung</th>
                    <th>NIK Wali</th>
                    <th>Nama Wali</th>
                </tr>
        ';
        while($row = mysqli_fetch_assoc($selectAnak)){
            $output .= '
            <tr>
                <td>'.$no.'</td>
                <td>'.$row["id_anakasuh"].'</td>
                <td>'.$row["nik_anak"].'</td>
                <td>'.$row["nama"].'</td>
                <td>'.$row["jenis_kelamin"].'</td>
                <td>'.$row["tempat_lahir"].'</td>
                <td>'.$row["tanggal_lahir"].'</td>
                <td>'.$row["alamat"].'</td>
                <td>'.$row["keterangan"].'</td>
                <td>'.$row["asrama"].'</td>
                <td>'.$row["no_akta"].'</td>
                <td>'.$row["no_kk"].'</td>
                <td>'.$row["no_skko"].'</td>
                <td>'.$row["status"].'</td>
                <td>'.$row["nama_sekolah"].'</td>
                <td>'.$row["tingkat"].'</td>
                <td>'.$row["kelas"].'</td>
                <td>'.$row["cabang"].'</td>
                <td>'.$row["deskripsi"].'</td>
                <td>'.$row["nik_ayah"].'</td>
                <td>'.$row["nama_ayah"].'</td>
                <td>'.$row["nik_ibu"].'</td>
                <td>'.$row["nama_ibu"].'</td>
                <td>'.$row["nik_wali"].'</td>
                <td>'.$row["nama_wali"].'</td>
            </tr>
            ';
            $no++;
        }
        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition:attachment; filename=Data Anak Asuh NHCare.xls");
        echo $output;
    }
}

?>