<?php 
// koneksi database
include 'koneksi.php';

$kodepr = $_POST['kode_perbaikan'];
$tgl = $_POST['tanggal_perbaikan'];
$guru = $_POST['id_guru'];



mysqli_query($koneksi,"insert into perbaikan values('', '$kodepr', '$guru', '$tgl')");


 
// mengalihkan halaman kembali ke index.php
header("location:perbaikan.php");
 
?>