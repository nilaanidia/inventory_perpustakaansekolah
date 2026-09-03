<?php 
// Koneksi database
include 'koneksi.php';

// Menangkap data ID yang dikirim dari URL
$id = $_GET['id_siswa'];

try {
    // Coba menghapus data dari tabel siswa
    $query = "DELETE FROM siswa WHERE id_siswa = '$id'";
    if (!mysqli_query($koneksi, $query)) {
        // Jika query gagal, lemparkan error
        throw new Exception("Gagal menghapus data: " . mysqli_error($koneksi));
    }
    // Jika berhasil, redirect ke halaman siswa dengan pesan sukses
    header("location:siswa.php");
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
