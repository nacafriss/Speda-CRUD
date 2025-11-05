<?php 
include "../config/koneksi.php";

$id = $_POST['id'];
$nim = $_POST['NIM'];
$nama = $_POST['Nama']; 
$jenis_kelamin = $_POST['Jenis_Kelamin'];

$sql = "UPDATE mahasiswa SET NIM='$nim', Nama='$nama', Jenis_Kelamin = '$jenis_kelamin' WHERE id='$id'";
$result = mysqli_query($koneksi, $sql);
if ($result) {
    header("Location: ../index.php");
}else{
    echo "Error : Gagal";
}

?>