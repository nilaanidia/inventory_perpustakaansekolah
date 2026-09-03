<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_peminjaman_guru'];
$ketpj = $_POST['keterangan_peminjaman'];
$peminjam = $_POST['id_peminjam'];


 
// update data ke database
mysqli_query($koneksi,"update peminjaman_guru set keterangan_peminjaman='$ketpj', id_peminjam='$peminjam' where id_peminjaman_guru='$id'");


// mengalihkan halaman kembali ke index.php
header("location:peminjaman_guru.php");
 
?>