<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_peminjaman'];
$pj = $_POST['id_peminjam'];
$idg = $_POST['id_guru'];
$dd = $_POST['id_denda'];
$tglpj = $_POST['tanggal_peminjaman'];
$tglp = $_POST['tanggal_pengembalian'];
$tglk = $_POST['tanggal_kembali'];

 
// update data ke database
mysqli_query($koneksi,"update peminjaman set id_peminjam='$pj', id_denda='$dd', id_guru='$idg', tanggal_peminjaman='$tglpj', tanggal_pengembalian='$tglp', tanggal_kembali='$tglk' where id_peminjaman='$id'");


// mengalihkan halaman kembali ke index.php
header("location:peminjaman.php");
 
?>