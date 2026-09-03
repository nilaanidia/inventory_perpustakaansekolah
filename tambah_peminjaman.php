<?php 
// koneksi database
include 'koneksi.php';

$kodepjm = $_POST['kode_peminjaman'];
$pj = $_POST['id_peminjam'];
$guru = $_POST['id_guru'];
$dd = $_POST['id_denda'];
$tglpj = $_POST['tanggal_peminjaman'];
$tglp = $_POST['tanggal_pengembalian'];
$tglk = $_POST['tanggal_kembali'];



mysqli_query($koneksi,"insert into peminjaman values('', '$kodepjm', '$pj', '$guru', '$dd', '$tglpj', '$tglk', '$tglp')");


 
// mengalihkan halaman kembali ke index.php
header("location:peminjaman.php");
 
?>