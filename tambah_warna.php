<?php 
// koneksi database
include 'koneksi.php';

$kodew = $_POST['kode_warna'];
$warna = $_POST['nama_warna'];



mysqli_query($koneksi,"insert into warna values('', '$kodew','$warna')");


 
// mengalihkan halaman kembali ke index.php
header("location:warna.php");
 
?>