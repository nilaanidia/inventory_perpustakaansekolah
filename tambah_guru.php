<?php 
// koneksi database
include 'koneksi.php';

$kodeg = $_POST['kode_guru'];
$nik = $_POST['nik'];
$guru = $_POST['nama_guru'];
$alamat = $_POST['alamat_guru'];
$tglguru = $_POST['tanggallahir_guru'];
$peminjam = $_POST['id_peminjam'];
$jabatan = $_POST['id_jabatan'];




mysqli_query($koneksi,"insert into guru values('', '$kodeg', '$jabatan', '$peminjam', '$nik', '$guru', '$alamat', '$tglguru' )");


 
// mengalihkan halaman kembali ke index.php
header("location:guru.php");
 
?>