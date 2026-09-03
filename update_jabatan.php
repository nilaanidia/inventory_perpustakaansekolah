<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_jabatan'];
$jabatan = $_POST['nama_jabatan'];

 
// update data ke database
mysqli_query($koneksi,"update jabatan set nama_jabatan='$jabatan' where id_jabatan='$id'");


// mengalihkan halaman kembali ke index.php
header("location:jabatan.php");
 
?>