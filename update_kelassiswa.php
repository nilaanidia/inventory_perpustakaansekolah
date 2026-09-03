<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_kelassiswa'];
$idj = $_POST['id_jurusan'];
$idk = $_POST['id_kelas'];
$namaks = $_POST['nama_kelassiswa'];
$rks = $_POST['ruangan_kelassiswa'];


 
// update data ke database
mysqli_query($koneksi,"update kelas_siswa set id_jurusan='$idj', id_kelas='$idk', nama_kelassiswa='$namaks', ruangan_kelassiswa='$rks' where id_kelassiswa='$id'");


// mengalihkan halaman kembali ke index.php
header("location:kelas_siswa.php");
 
?>