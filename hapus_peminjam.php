<?php 
// Koneksi database
include 'koneksi.php';

// Menangkap data ID yang dikirim dari URL
$id = $_GET['id_peminjam'];

try {
    // Coba menghapus data dari tabel peminjam
    $query = "DELETE FROM peminjam WHERE id_peminjam = '$id'";
    if (!mysqli_query($koneksi, $query)) {
        // Jika query gagal, lemparkan error
        throw new Exception("Gagal menghapus data: " . mysqli_error($koneksi));
    }
    // Jika berhasil, redirect ke halaman peminjam dengan pesan sukses
    header("location:peminjam.php");
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
