<?php
include 'koneksi.php';

$id_peminjam = $_GET['id_peminjam'];

// Ambil guru yang terkait dengan id_peminjam
$query = "
    SELECT g.id_guru, g.nama_guru 
    FROM guru g 
    WHERE g.id_peminjam = '$id_peminjam'
";

$result = mysqli_query($koneksi, $query);

$options = '<option value="" disabled >Pilih Guru</option>';
while ($guru = mysqli_fetch_assoc($result)) {
    $options .= '<option value="' . $guru['id_guru'] . '">' . $guru['nama_guru'] . '</option>';
}

echo $options;
?>