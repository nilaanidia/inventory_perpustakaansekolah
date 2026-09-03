<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_warna'];
$warna = $_POST['nama_warna'];

 
// update data ke database
mysqli_query($koneksi,"update warna set nama_warna='$warna' where id_warna='$id'");


// mengalihkan halaman kembali ke index.php
header("location:warna.php");
 
?>