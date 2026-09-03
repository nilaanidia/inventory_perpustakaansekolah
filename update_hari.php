<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_hari'];
$hari = $_POST['nama_hari'];

 
// update data ke database
mysqli_query($koneksi,"update hari set nama_hari='$hari' where id_hari='$id'");


// mengalihkan halaman kembali ke index.php
header("location:hari.php");
 
?>