<?php 
include "../config/koneksi.php";

$nim = $_POST['NIM'];
$nama = $_POST['Nama'];
$jenis_kelamin = $_POST['Jenis_Kelamin'];

$sql = "INSERT INTO mahasiswa (NIM, Nama, Jenis_Kelamin) VALUES (?, ?, ?)";

$stmt = $koneksi->prepare($sql);
$stmt->bind_param("sss", $nim, $nama, $jenis_kelamin);

if($stmt->execute()){
    header("location:../index.php");
}else{
    echo "Error: $stmt->error";
}

$stmt->close();
$koneksi->close();

?>