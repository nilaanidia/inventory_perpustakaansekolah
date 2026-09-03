<?php
include 'koneksi.php';

$kode_peralatan = $_POST['kode_peralatan'];
$idj = $_POST['id_jenis'];
$idm = $_POST['id_merk'];
$idw = $_POST['id_warna'];
$username_peralatan = $_POST['nama_peralatan'];
$password_peralatan = $_POST['tanggalbeli_peralatan'];
$status_peralatan = $_POST['status_peralatan'];
$role_peralatan = $_POST['jumlahkerusakan_peralatan'];
$keterangan_peringatan = $_POST['statusketersediaan_peralatan'];
$atsp = $_POST['aturanservice_peralatan'];
$img = $_POST['gambar_peralatan'];

// Handle file upload
if (isset($_FILES['gambar_peralatan']['name']) && $_FILES['gambar_peralatan']['name'] != '') {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["gambar_peralatan"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name; // Add timestamp to avoid file name conflicts

    if (move_uploaded_file($_FILES["gambar_peralatan"]["tmp_name"], $target_file)) {
        // File uploaded successfully
        $image_path = $target_file;
    } else {
        die("Gagal mengunggah gambar.");
    }
} else {
    $image_path = ""; // Default empty path if no file uploaded
}

// Insert data into the database
$query = "INSERT INTO peralatan (kode_peralatan, id_jenis, id_merk, id_warna, nama_peralatan, tanggalbeli_peralatan, status_peralatan, jumlahkerusakan_peralatan, statusketersediaan_peralatan, aturanservice_peralatan, image_peralatan) 
          VALUES ('$kode_peralatan', '$idj', '$idm', '$idw', '$username_peralatan', '$password_peralatan', '$status_peralatan', '$role_peralatan', '$keterangan_peringatan', '$atsp', '$img')";

if (mysqli_query($koneksi, $query)) {
    header("Location:peralatan.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
