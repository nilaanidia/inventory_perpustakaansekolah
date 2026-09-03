<?php 
// Koneksi database
include 'koneksi.php';

// Menangkap data ID yang dikirim dari URL
$id = $_GET['id_merk'];

try {
    // Coba menghapus data dari tabel merk
    $query = "DELETE FROM merk WHERE id_merk = '$id'";
    if (!mysqli_query($koneksi, $query)) {
        // Jika query gagal, lemparkan error
        throw new Exception("Gagal menghapus data: " . mysqli_error($koneksi));
    }
    // Jika berhasil, redirect ke halaman merk dengan pesan sukses
    header("location:merk.php");
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
