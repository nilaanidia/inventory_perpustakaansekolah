<?php 
// koneksi database
include 'koneksi.php';

$kodeks = $_POST['kode_kelassiswa'];
$idj = $_POST['id_jurusan'];
$idk = $_POST['id_kelas'];
$namaks = $_POST['nama_kelassiswa'];
$rks = $_POST['ruangan_kelassiswa'];


mysqli_query($koneksi,"insert into kelas_siswa values('', '$kodeks','$idj','$idk','$namaks','$rks')");


 
// mengalihkan halaman kembali ke index.php
header("location:kelas_siswa.php");
 
?>