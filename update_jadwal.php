<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_jadwal'];
$idks = $_POST['id_kelassiswa'];
$idpl = $_POST['id_pelajaran'];
$idg = $_POST['id_guru'];
$idh = $_POST['id_hari'];
$jms = $_POST['jam_masuk'];
$jkl = $_POST['jam_keluar'];
$sms = $_POST['semester'];

 
// update data ke database
mysqli_query($koneksi,"update jadwal set id_kelassiswa='$idks', id_pelajaran='$idpl', id_guru='$idg', id_hari='$idh', jam_masuk='$jms', jam_keluar='$jkl', semester='$sms' where id_jadwal='$id'");


// mengalihkan halaman kembali ke index.php
header("location:jadwal.php");
 
?>