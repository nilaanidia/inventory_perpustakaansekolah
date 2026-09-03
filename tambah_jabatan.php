<?php 
// koneksi database
include 'koneksi.php';

$kodej = $_POST['kode_jabatan'];
$jabatan = $_POST['nama_jabatan'];



mysqli_query($koneksi,"insert into jabatan values('','$kodej','$jabatan')");


 
// mengalihkan halaman kembali ke index.php
header("location:jabatan.php");
 
?>