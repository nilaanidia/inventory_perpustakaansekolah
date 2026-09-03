<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_pemesanan'];
$peminjam = $_POST['id_peminjam'];
$tanggpem = $_POST['tanggal_pemesanan'];
$stapem = $_POST['status_pemesanan'];


 
// update data ke database
mysqli_query($koneksi,"update pemesanan set tanggal_pemesanan='$tanggpem', id_peminjam='$peminjam', status_pemesanan='$stapem' where id_pemesanan='$id'");


// mengalihkan halaman kembali ke index.php
header("location:pemesanan.php");
 
?>