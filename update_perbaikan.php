<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_perbaikan'];
$idg = $_POST['id_guru'];
$tglpb = $_POST['tanggal_perbaikan'];

 
// update data ke database
mysqli_query($koneksi,"update perbaikan set tanggal_perbaikan='$tglpb', id_guru='$idg' where id_perbaikan='$id'");


// mengalihkan halaman kembali ke index.php
header("location:perbaikan.php");
 
?>