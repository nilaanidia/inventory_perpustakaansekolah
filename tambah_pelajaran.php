<?php 
// koneksi database
include 'koneksi.php';

$kodep = $_POST['kode_pelajaran'];
$pelajaran = $_POST['nama_pelajaran'];



mysqli_query($koneksi,"insert into pelajaran values('', '$kodep','$pelajaran')");


 
// mengalihkan halaman kembali ke index.php
header("location:pelajaran.php");
 
?>