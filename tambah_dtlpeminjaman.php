<?php
// Koneksi database
include 'koneksi.php';

// Ambil data dari form
$kodeks = $_POST['kode_dtlpeminjaman'];
$idj = $_POST['id_peminjaman'];
$idk = $_POST['id_peralatan'];

$result = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE ID_PEMINJAMAN = '$idj'");
if (mysqli_num_rows($result) == 0) {
    die("Error: ID Peminjaman ($idj) tidak ditemukan di tabel peminjaman.");
}

// Insert data ke tabel detail_peminjaman
$query = "INSERT INTO detail_peminjaman (kode_dtlpeminjaman, ID_PEMINJAMAN, ID_PERALATAN) 
          VALUES ('$kodeks', '$idj', '$idk')";
if (!mysqli_query($koneksi, $query)) {
    // Jika terjadi error, tampilkan pesan error
    die("Error: " . mysqli_error($koneksi));
}

// Alihkan ke halaman detail_peminjaman.php
header("Location: detail_peminjaman.php");
exit;
?>
