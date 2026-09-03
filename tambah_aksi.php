<?php 
// koneksi database
include 'koneksi.php';


$kodejr = $_POST['kode_jurusan'];
$jurusan = $_POST['nama_jurusan'];
$skt = $_POST['singkatan'];



mysqli_query($koneksi,"insert into jurusan values('', '$kodejr','$jurusan','$skt')");


 
// mengalihkan halaman kembali ke index.php
header("location:jurusan.php");
 
?>