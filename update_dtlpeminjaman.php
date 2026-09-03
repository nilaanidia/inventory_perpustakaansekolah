<?php
// Koneksi database
include 'koneksi.php';

// Ambil data dari form
$id_detail = $_POST['id_detail_peminjaman']; // ID dari record yang akan diupdate
$kodeks = $_POST['kode_dtlpeminjaman'];
$idj = $_POST['id_peminjaman'];
$idk = $_POST['id_peralatan'];

// Validasi apakah ID peminjaman ada di tabel referensi (peminjaman)
$result = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE ID_PEMINJAMAN = '$idj'");
if (mysqli_num_rows($result) == 0) {
    // Jika tidak ditemukan, tampilkan pesan error dan hentikan eksekusi
    die("Error: ID Peminjaman ($idj) tidak ditemukan di tabel peminjaman.");
}

// Update data di tabel detail_peminjaman
$query = "UPDATE detail_peminjaman 
          SET kode_dtlpeminjaman = '$kodeks', ID_PEMINJAMAN = '$idj', ID_PERALATAN = '$idk' 
          WHERE id_detail_peminjaman = '$id_detail'";
if (!mysqli_query($koneksi, $query)) {
    // Jika terjadi error, tampilkan pesan error
    die("Error: " . mysqli_error($koneksi));
}

// Alihkan ke halaman detail_peminjaman.php
header("Location: detail_peminjaman.php");
exit;
?>
