<?php 
// koneksi database
include 'koneksi.php';

$kodepjm = $_POST['kode_peminjaman_guru'];
$ketpj = $_POST['keterangan_peminjaman'];
$peminjam = $_POST['id_peminjam'];



mysqli_query($koneksi,"insert into peminjaman_guru values('', '$kodepjm', '$peminjam', '$ketpj')");


 
// mengalihkan halaman kembali ke index.php
header("location:peminjaman_guru.php");
 
?>