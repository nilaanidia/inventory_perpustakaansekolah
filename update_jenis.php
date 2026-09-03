<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_jenis'];
$jenis = $_POST['nama_jenis'];

 
// update data ke database
mysqli_query($koneksi,"update jenis set nama_jenis='$jenis' where id_jenis='$id'");


// mengalihkan halaman kembali ke index.php
header("location:jenis.php");
 
?>