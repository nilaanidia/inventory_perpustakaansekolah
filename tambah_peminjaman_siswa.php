<?php 
// koneksi database
include 'koneksi.php';

$kodeps = $_POST['kode_peminjaman_siswa'];
$idp = $_POST['id_peminjam'];
$mtp = $_POST['mata_pelajaran'];
$gp = $_POST['guru_pengajar'];



mysqli_query($koneksi,"insert into peminjaman_siswa values('', '$kodeps', '$idp', '$mtp', '$gp')");

 
// mengalihkan halaman kembali ke index.php
header("location:peminjaman_siswa.php");
 
?>
