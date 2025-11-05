<?php
$host = "localhost";
$port = 3306; 
$username = "root";
$password = "";
$database = "mahasiswa_web";


$koneksi = new mysqli($host, $username, $password, $database, $port);

if($koneksi){
  
}else{
    echo "Koneksi mati";
    die;
}
