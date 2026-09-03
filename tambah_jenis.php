<?php 
// koneksi database
include 'koneksi.php';

$kodejn = $_POST['kode_jenis'];
$jenis = $_POST['nama_jenis'];



mysqli_query($koneksi,"insert into jenis values('', '$kodejn','$jenis')");


 
// mengalihkan halaman kembali ke index.php
header("location:jenis.php");
 
?>