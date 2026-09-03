<?php
// Koneksi database
include 'koneksi.php';

// Ambil data dari form
$kodeks = $_POST['kode_dtlpemesanan'];
$idj = $_POST['id_pemesanan'];
$idk = $_POST['id_peralatan'];

$result = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE id_pemesanan = '$idj'");
if (mysqli_num_rows($result) == 0) {
    die("Error: ID pemesanan ($idj) tidak ditemukan di tabel pemesanan.");
}

// Insert data ke tabel detail_pemesanan
$query = "INSERT INTO detail_pemesanan (kode_dtlpemesanan, id_pemesanan, ID_PERALATAN) 
          VALUES ('$kodeks', '$idj', '$idk')";
if (!mysqli_query($koneksi, $query)) {
    // Jika terjadi error, tampilkan pesan error
    die("Error: " . mysqli_error($koneksi));
}

// Alihkan ke halaman detail_pemesanan.php
header("Location: detail_pemesanan.php");
exit;
?>
