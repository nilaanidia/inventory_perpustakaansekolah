<?php 
// koneksi database
include 'koneksi.php';

$kodeks = $_POST['kode_dtlperbaikan'];
$idj = $_POST['id_perbaikan'];
$idk = $_POST['id_peralatan'];
$namaks = $_POST['keterangan'];


mysqli_query($koneksi,"insert into detail_perbaikan values('', '$kodeks','$idj','$idk','$namaks')");


 
// mengalihkan halaman kembali ke index.php
header("location:detail_perbaikan.php");
 
?>