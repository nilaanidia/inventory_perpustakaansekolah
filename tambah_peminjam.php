<?php
include 'koneksi.php';

$kode_peminjam = $_POST['kode_peminjam'];
$username_peminjam = $_POST['username_peminjam'];
$password_peminjam = $_POST['password_peminjam'];
$status_peminjam = $_POST['status_peminjam'];
$role_peminjam = $_POST['role_peminjam'];
$keterangan_peringatan = $_POST['keterangan_peringatan'];

// Handle file upload
if (isset($_FILES['gambar_peminjam']['name']) && $_FILES['gambar_peminjam']['name'] != '') {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["gambar_peminjam"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name; // Add timestamp to avoid file name conflicts

    if (move_uploaded_file($_FILES["gambar_peminjam"]["tmp_name"], $target_file)) {
        // File uploaded successfully
        $image_path = $target_file;
    } else {
        die("Gagal mengunggah gambar.");
    }
} else {
    $image_path = ""; // Default empty path if no file uploaded
}

// Insert data into the database
$query = "INSERT INTO peminjam (kode_peminjam, username_peminjam, password_peminjam, status_peminjam, keterangan_peringatan, image_peminjam, role_peminjam) 
          VALUES ('$kode_peminjam', '$username_peminjam', '$password_peminjam', '$status_peminjam', '$keterangan_peringatan', '$image_path', '$role_peminjam')";

if (mysqli_query($koneksi, $query)) {
    header("Location:peminjam.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
