<?php 
// koneksi database
include 'koneksi.php';

$kodejd = $_POST['kode_jadwal'];
$idks = $_POST['id_kelassiswa'];
$idpl = $_POST['id_pelajaran'];
$idg = $_POST['id_guru'];
$idh = $_POST['id_hari'];
$jms = $_POST['jam_masuk'];
$jkl = $_POST['jam_keluar'];
$sms = $_POST['semester'];


mysqli_query($koneksi,"insert into jadwal values('', '$kodejd','$idks','$idpl','$idg','$idh','$jms','$jkl','$sms')");


 
// mengalihkan halaman kembali ke index.php
header("location:jadwal.php");
 
?>