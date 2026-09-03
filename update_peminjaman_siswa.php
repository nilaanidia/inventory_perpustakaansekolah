<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form

$ids = $_POST['id_peminjaman_siswa'];
$id = $_POST['id_peminjam'];
$mapel = $_POST['mata_pelajaran'];
$guper = $_POST['guru_pengajar'];


 
// update data ke database
mysqli_query($koneksi,"update peminjaman_siswa set id_peminjam='$id', guru_pengajar='$guper',mata_pelajaran='$mapel'  where id_peminjaman_siswa='$ids'");


// mengalihkan halaman kembali ke index.php
header("location:peminjaman_siswa.php");
 
?>