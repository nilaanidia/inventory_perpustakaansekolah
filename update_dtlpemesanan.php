<?php
// Koneksi database
include 'koneksi.php';

// Ambil data dari form
$id_detail = $_POST['id_detail_pemesanan']; // ID dari record yang akan diupdate
$kodeks = $_POST['kode_dtlpemesanan'];
$idj = $_POST['id_pemesanan'];
$idk = $_POST['id_peralatan'];

// Validasi apakah ID pemesanan ada di tabel referensi (pemesanan)
$result = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE ID_pemesanan = '$idj'");
if (mysqli_num_rows($result) == 0) {
    // Jika tidak ditemukan, tampilkan pesan error dan hentikan eksekusi
    die("Error: ID pemesanan ($idj) tidak ditemukan di tabel pemesanan.");
}

// Update data di tabel detail_pemesanan
$query = "UPDATE detail_pemesanan 
          SET kode_dtlpemesanan = '$kodeks', ID_pemesanan = '$idj', ID_PERALATAN = '$idk' 
          WHERE id_detail_pemesanan = '$id_detail'";
if (!mysqli_query($koneksi, $query)) {
    // Jika terjadi error, tampilkan pesan error
    die("Error: " . mysqli_error($koneksi));
}

// Alihkan ke halaman detail_pemesanan.php
header("Location: detail_pemesanan.php");
exit;
?>
