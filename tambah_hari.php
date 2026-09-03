<?php 
// koneksi database
include 'koneksi.php';

$kodeh = $_POST['kode_hari'];
$hari = $_POST['nama_hari'];



mysqli_query($koneksi,"insert into hari values('', '$kodeh', '$hari')");


 
// mengalihkan halaman kembali ke index.php
header("location:hari.php");
 
?>