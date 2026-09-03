<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_merk'];
$merk = $_POST['nama_merk'];

 
// update data ke database
mysqli_query($koneksi,"update merk set nama_merk='$merk' where id_merk='$id'");


// mengalihkan halaman kembali ke index.php
header("location:merk.php");
 
?>