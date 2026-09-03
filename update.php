<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_jurusan'];
$jurusan = $_POST['nama_jurusan'];
$skt = $_POST['singkatan'];

 
// update data ke database
mysqli_query($koneksi,"update jurusan set nama_jurusan='$jurusan', singkatan='$skt' where id_jurusan='$id'");


// mengalihkan halaman kembali ke index.php
header("location:jurusan.php");
 
?>