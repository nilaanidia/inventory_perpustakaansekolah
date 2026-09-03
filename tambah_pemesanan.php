<?php 
// koneksi database
include 'koneksi.php';

$kopem = $_POST['kode_pemesanan'];
$peminjam = $_POST['id_peminjam'];
$tanggpem = $_POST['tanggal_pemesanan'];
$stapem = $_POST['status_pemesanan'];



mysqli_query($koneksi,"insert into pemesanan values('', '$kopem','$peminjam','$tanggpem','$stapem')");


 
// mengalihkan halaman kembali ke index.php
header("location:pemesanan.php");
 
?>