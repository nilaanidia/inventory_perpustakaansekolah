<?php 
// koneksi database
include 'koneksi.php';

$denda = $_POST['denda'];
$koded = $_POST['kode_denda'];



mysqli_query($koneksi,"insert into denda values('','$koded','$denda')");


 
// mengalihkan halaman kembali ke index.php
header("location:denda.php");
 
?>