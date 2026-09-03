<?php 
// koneksi database
include 'koneksi.php';


$kodek = $_POST['kode_kelas'];
$kelas = $_POST['nama_kelas'];



mysqli_query($koneksi,"insert into kelas values('', '$kodek','$kelas')");


 
// mengalihkan halaman kembali ke index.php
header("location:kelas.php");
 
?>