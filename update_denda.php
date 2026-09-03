<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_denda'];
$denda = $_POST['denda'];

 
// update data ke database
mysqli_query($koneksi,"update denda set denda='$denda' where id_denda='$id'");


// mengalihkan halaman kembali ke index.php
header("location:denda.php");
 
?>