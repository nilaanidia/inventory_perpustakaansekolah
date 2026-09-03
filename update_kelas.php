<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_kelas'];
$kelas = $_POST['nama_kelas'];

 
// update data ke database
mysqli_query($koneksi,"update kelas set nama_kelas='$kelas' where id_kelas='$id'");


// mengalihkan halaman kembali ke index.php
header("location:kelas.php");
 
?>