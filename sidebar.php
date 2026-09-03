<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Memulai session jika session belum dimulai
}
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

	<div class="">
    <a href="index.php" class="brand-link">
      <img src="uploads/Logo.png" alt="" class="brand-image img-circle" style="opacity: .8">
      <span class="brand-text font-weight-light">SMK ABC SURABAYA</span>
    </a>
	</div>



<!-- Sidebar -->
    <div class="sidebar mt-2">
      

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



          <li class="nav-item">
		      <a href="index.php" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profile
              </p>
            </a>

            <?php if ($role == 'admin') { ?>
                <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          MASTER
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="jurusan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jurusan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="kelas.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelas</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="hari.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Hari</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="jabatan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jabatan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="denda.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Denda</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="jenis.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jenis</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="merk.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Merk</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="pelajaran.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pelajaran</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="warna.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Warna</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="peminjam.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjam</p>
                          </a>
                  </li>
                </ul>
              </li>
              <?php } ?>
                <?php if ($role == 'guru' || $role == 'siswa' || $role == 'admin') { ?>
                <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                          TRANSAKSI
                          <i class="fas fa-angle-left right"></i>
                        </p>
                      </a>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="perbaikan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Perbaikan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="guru.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Guru</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="peminjaman_guru.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjaman Guru</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="peminjaman_siswa.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjaman Siswa</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="pemesanan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pemesanan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="siswa.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Siswa</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="kelas_siswa.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kelas Siswa</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="jadwal.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jadwal</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="peralatan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peralatan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="peminjaman.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Peminjaman</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="detail_perbaikan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Detail Perbaikan</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="detail_peminjaman.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Detail Peminjaman</p>
                          </a>
                  </li>
                        <li class="nav-item">
                          <a href="detail_pemesanan.php" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Detail Pemesanan</p>
                          </a>
                  </li>
                </ul>
                <?php } ?>
             
                    </li>
              <li class="nav-item">
		      <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
              Logout
              </p>
            </a>
              </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
