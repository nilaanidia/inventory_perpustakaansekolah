<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_detail_perbaikan'];
$idj = $_POST['id_perbaikan'];
$idk = $_POST['id_peralatan'];
$namaks = $_POST['keterangan'];


 
// update data ke database
mysqli_query($koneksi,"update detail_perbaikan set id_perbaikan='$idj', id_peralatan='$idk', keterangan='$namaks' where id_detail_perbaikan='$id'");


// mengalihkan halaman kembali ke index.php
header("location:detail_perbaikan.php");
 
?>