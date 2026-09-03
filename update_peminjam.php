<?php
include 'koneksi.php';

$id_peminjam = $_POST['id_peminjam'];
$username_peminjam = $_POST['username_peminjam'];
$password_peminjam = $_POST['password_peminjam'];
$status_peminjam = $_POST['status_peminjam'];
$role_peminjam = $_POST['role_peminjam'];
$keterangan_peringatan = $_POST['keterangan_peringatan'];

// Check if a new image is uploaded
if (isset($_FILES['gambar_peminjam']['name']) && $_FILES['gambar_peminjam']['name'] != '') {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["gambar_peminjam"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;

    if (move_uploaded_file($_FILES["gambar_peminjam"]["tmp_name"], $target_file)) {
        // Update with the new image
        $query = "UPDATE peminjam 
                  SET username_peminjam = '$username_peminjam', 
                      password_peminjam = '$password_peminjam', 
                      status_peminjam = '$status_peminjam', 
                      role_peminjam = '$role_peminjam',
                      keterangan_peringatan = '$keterangan_peringatan', 
                      image_peminjam = '$target_file' 
                  WHERE id_peminjam = '$id_peminjam'";
    } else {
        die("Gagal mengunggah gambar.");
    }
} else {
    // Update without changing the image
    $query = "UPDATE peminjam 
              SET username_peminjam = '$username_peminjam', 
                  password_peminjam = '$password_peminjam', 
                  status_peminjam = '$status_peminjam', 
                  role_peminjam = '$role_peminjam',
                  keterangan_peringatan = '$keterangan_peringatan' 
              WHERE id_peminjam = '$id_peminjam'";
}

if (mysqli_query($koneksi, $query)) {
    header("Location: peminjam.php");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
