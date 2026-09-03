<?php 
// koneksi database
include 'koneksi.php';

// Mengambil data dari form
$kodes = $_POST['kode_siswa'];
$id = $_POST['id_peminjam'];
$idks = $_POST['id_kelassiswa'];
$nis = $_POST['nis'];
$nasis = $_POST['nama_siswa'];
$alsis = $_POST['alamat_siswa'];
$angsis = $_POST['angkatan_siswa'];
$ketsis = $_POST['keterangan_siswa'];

// Menyisipkan data ke tabel peminjaman_siswa
mysqli_query($koneksi, "INSERT INTO siswa VALUES('', '$kodes', '$id', '$idks', '$nis', '$nasis', '$alsis', '$angsis', '$ketsis')");

// Mengalihkan ke halaman siswa.php
header("Location: siswa.php");
?>
