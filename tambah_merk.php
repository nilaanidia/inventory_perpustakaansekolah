<?php 
// koneksi database
include 'koneksi.php';

$kodem = $_POST['kode_merk'];
$merk = $_POST['nama_merk'];



mysqli_query($koneksi,"insert into merk values('', '$kodem','$merk')");


 
// mengalihkan halaman kembali ke index.php
header("location:merk.php");
 
?>