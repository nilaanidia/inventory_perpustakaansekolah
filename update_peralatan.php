<?php
include 'koneksi.php';

$id_peralatan = $_POST['id_peralatan'];
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

// Handle file upload
$image_path = $_POST['gambar_lama']; // Default to the old image path
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
}

// Update data in the database
$query = "UPDATE peralatan SET 
            kode_peralatan = '$kode_peralatan', 
            id_jenis = '$idj', 
            id_merk = '$idm', 
            id_warna = '$idw', 
            nama_peralatan = '$username_peralatan', 
            tanggalbeli_peralatan = '$password_peralatan', 
            status_peralatan = '$status_peralatan', 
            jumlahkerusakan_peralatan = '$role_peralatan', 
            statusketersediaan_peralatan = '$keterangan_peringatan', 
            aturanservice_peralatan = '$atsp', 
            image_peralatan = '$image_path' 
          WHERE id_peralatan = '$id_peralatan'";

if (mysqli_query($koneksi, $query)) {
    header("Location:peralatan.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
