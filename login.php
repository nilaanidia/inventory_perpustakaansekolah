<?php
session_start();
require 'koneksi.php'; // Menggunakan koneksi Anda

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek input kosong
    if (!empty($username) && !empty($password)) {
        // Query ke database
        $query = $koneksi->prepare("SELECT id_peminjam, username_peminjam, password_peminjam, role_peminjam FROM peminjam WHERE username_peminjam = ? AND password_peminjam = ?");
        $query->bind_param("ss", $username, $password);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows === 1) {
            // Ambil data user dan role dari database
            $row = $result->fetch_assoc();
            $role_peminjam = $row['role_peminjam'];  // Ambil nilai role_peminjam
        
            // Set session
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role_peminjam; // Simpan role peminjam
        
            header("Location: index.php"); // Redirect ke halaman dashboard
            exit();
        }
         else {
            $error = "Username atau Password salah!";
        }
    } else {
        $error = "Harap isi semua kolom!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
  <div class="card shadow-lg" style="max-width: 400px; width: 100%;">
    <div class="card-body">
      <h3 class="text-center mb-4">Login</h3>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center" role="alert">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>
      <form method="POST" action="">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
