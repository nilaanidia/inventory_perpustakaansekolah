<?php 
// Koneksi database
include 'koneksi.php';

// Menangkap data ID yang dikirim dari URL
$id = $_GET['id_detail_pemesanan'];

try {
    // Coba menghapus data dari tabel detail_pemesanan
    $query = "DELETE FROM detail_pemesanan WHERE id_detail_pemesanan = '$id'";
    if (!mysqli_query($koneksi, $query)) {
        // Jika query gagal, lemparkan error
        throw new Exception("Gagal menghapus data: " . mysqli_error($koneksi));
    }
    // Jika berhasil, redirect ke halaman detail_pemesanan dengan pesan sukses
    header("location:detail_pemesanan.php");
} catch (Exception $e) {
    // Tampilkan pesan error dalam alert dan redirect kembali
    echo "<script>
        alert('Data tidak dapat dihapus, karena data sedang dipakai');
        window.history.back();
    </script>";
}

// Tutup koneksi
mysqli_close($koneksi);
?>
