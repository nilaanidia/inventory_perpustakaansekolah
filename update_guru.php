<?php 
// koneksi database
include 'koneksi.php';
 
// menangkap data yang di kirim dari form
$id = $_POST['id_guru'];
$nik = $_POST['nik'];
$guru = $_POST['nama_guru'];
$alamat = $_POST['alamat_guru'];
$tglguru = $_POST['tanggallahir_guru'];
$peminjam = $_POST['id_peminjam'];
$jabatan = $_POST['id_jabatan'];

 
// update data ke database
mysqli_query($koneksi,"update guru set nik='$nik', nama_guru='$guru', alamat_guru='$alamat', tanggallahir_guru='$tglguru', id_peminjam='$peminjam', id_jabatan='$jabatan' where id_guru='$id'");


// mengalihkan halaman kembali ke index.php
header("location:guru.php");
 
?>