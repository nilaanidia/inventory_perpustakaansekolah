<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_siswa'];
$idp = $_POST['id_peminjam'];
$idks = $_POST['id_kelassiswa'];
$nis = $_POST['nis'];
$nasis = $_POST['nama_siswa'];
$alsis = $_POST['alamat_siswa'];
$angsis = $_POST['angkatan_siswa'];
$ketsis = $_POST['keterangan_siswa'];


 
// update data ke database
mysqli_query($koneksi,"update siswa set id_peminjam='$id', id_kelassiswa='$idks', nis='$nis', nama_siswa='$nasis', angkatan_siswa='$angsis', alamat_siswa='$alsis', nis='$nis', keterangan_siswa='$ketsis' where id_siswa='$id'");


// mengalihkan halaman kembali ke index.php
header("location:siswa.php");
 
?>