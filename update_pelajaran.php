<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_pelajaran'];
$pelajaran = $_POST['nama_pelajaran'];

 
// update data ke database
mysqli_query($koneksi,"update pelajaran set nama_pelajaran='$pelajaran' where id_pelajaran='$id'");


// mengalihkan halaman kembali ke index.php
header("location:pelajaran.php");
 
?>