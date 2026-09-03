

  <!-- Navbar -->
  <?php 
		include 'navbar.php';
		?>
  <!-- /.navbar -->


    <?php 
		include 'sidebar.php';
		?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<div class="card mt-3">
              <div class="card-header">
                <h3 class="card-title">Master Peminjam</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
				<!-- Button trigger modal -->
				<button type="button" class="btn btn-flat btn-outline-primary mb-3" data-toggle="modal" data-target="#exampleModal">
				Tambah Baru
				</button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Tambah Peminjam</h5>
						</div>
						<div class="modal-body">
						<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_peminjam FROM peminjam ORDER BY id_peminjam DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_peminjam'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PMJM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PMJM001';
								}
								?>
						<form class="form-horizontal" method="post" action="tambah_peminjam.php" enctype="multipart/form-data" onsubmit="return validateForm()">
								<div class="card-body">
								<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_peminjam" id="kode_peminjam" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Username</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjam" value="<?php echo $d['id_peminjam']; ?>">
											<input type="text" class="form-control" name="username_peminjam" id="username_peminjam" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Password</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjam" value="<?php echo $d['id_peminjam']; ?>">
											<input type="text" class="form-control" name="password_peminjam" id="password_peminjam" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Status</label>
										<div class="col-sm-10 mt-2 d-flex">
											<input type="hidden" name="id_peminjam" value="<?php echo $d['id_peminjam']; ?>">
											<div class="form-check mr-3">
												<input class="form-check-input" type="radio" name="status_peminjam" id="status_aktif" value="aktif" checked>
												<label class="form-check-label" for="status_aktif">Aktif</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="status_peminjam" id="status_tidak_aktif" value="tidak_aktif">
												<label class="form-check-label" for="status_tidak_aktif">Tidak Aktif</label>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Role</label>
										<div class="col-sm-10">
											<select class="form-control" name="role_peminjam" id="role_peminjam" required>
												<option value="" disabled selected>Pilih Role</option>
												<option value="admin">Admin</option>
												<option value="guru">Guru</option>
												<option value="siswa">Siswa</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Peringatan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjam" value="<?php echo $d['id_peminjam']; ?>">
											<input type="text" class="form-control" name="keterangan_peringatan" id="keterangan_peringatan" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Image</label>
										<div class="col-sm-10">
											<input type="file" class="form-control-file" name="gambar_peminjam" id="gambar_peminjam" accept="image/*" >
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearForm()">Batal</button>
										<button type="submit" value="submit" class="btn btn-primary">Simpan</button>
									</div>
								</div>
							</form>
							</div>
						</div>
					</div>
					</div>
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Peringatan</th>
                    <th>Image</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select id_peminjam, kode_peminjam, username_peminjam, role_peminjam, password_peminjam, status_peminjam, keterangan_peringatan, image_peminjam from peminjam";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_peminjam']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td>
					<td><?php echo str_repeat('*', strlen($d['password_peminjam'])); ?></td>
					<td><?php echo $d['status_peminjam']; ?></td>
					<td><?php echo $d['role_peminjam']; ?></td>
					<td><?php echo $d['keterangan_peringatan']; ?></td>
					<td>
						<?php if (!empty($d['image_peminjam']) && file_exists($d['image_peminjam'])): ?>
							<img src="<?php echo $d['image_peminjam']; ?>" alt="Image" class="img-fluid" style="max-width: 100px; height: 80px;">
						<?php else: ?>
							<img src="uploads/placeholder.jpg" alt="No Image" class="img-fluid" style="max-width: 100px; height: 60px;">
						<?php endif; ?>
					</td>

					<td>
						<div class="row">
						<div class="col">
							<button type="button" class="btn btn-block btn-xs btn-outline-danger " data-toggle="modal" data-target="#hapus<?= $no ?>">
						Hapus
						</button>

						<div class="modal fade" id="hapus<?= $no ?>" tabindex="-1" aria-labelledby="modalHapus" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalHapus">Hapus peminjam</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_peminjam.php?id_peminjam=<?php echo $d['id_peminjam']; ?>">
									<button type="button" class="btn btn-danger p-2">Yes</button>
								</a>
							</div>
							</div>
						</div>
						</div>

						
						<button type="button" class="btn btn-block btn-xs btn-outline-success mt-2" data-toggle="modal" data-target="#Edit<?= $no ?>">
							Edit
						</button>

						<div class="modal fade" id="Edit<?= $no ?>" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="modalEdit">Edit Pelajaran</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form class="form-horizontal" method="post" action="update_peminjam.php" enctype="multipart/form-data">
										<div class="modal-body">
											<div class="card-body">
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Kode</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="kode_peminjam" value="<?php echo $d['kode_peminjam']; ?>" readonly>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Username</label>
													<div class="col-sm-10">
														<input type="hidden" name="id_peminjam" value="<?php echo $d['id_peminjam']; ?>">
														<input type="text" class="form-control" name="username_peminjam" value="<?php echo $d['username_peminjam']; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Password</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="password_peminjam" value="<?php echo $d['password_peminjam']; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Status</label>
													<div class="col-sm-10 mt-2 d-flex">
														<div class="form-check mr-3">
															<input class="form-check-input" type="radio" name="status_peminjam" value="aktif" <?= ($d['status_peminjam'] === 'aktif') ? 'checked' : ''; ?>>
															<label class="form-check-label">Aktif</label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="status_peminjam" value="tidak_aktif" <?= ($d['status_peminjam'] === 'tidak_aktif') ? 'checked' : ''; ?>>
															<label class="form-check-label">Tidak Aktif</label>
														</div>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Role</label>
													<div class="col-sm-10">
														<select class="form-control" name="role_peminjam" required>
															<option value=""> Pilih Role </option>
															<option value="admin" <?= ($d['role_peminjam'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
															<option value="guru" <?= ($d['role_peminjam'] === 'guru') ? 'selected' : ''; ?>>Guru</option>
															<option value="siswa" <?= ($d['role_peminjam'] === 'siswa') ? 'selected' : ''; ?>>Siswa</option>
														</select>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Peringatan</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" name="keterangan_peringatan" value="<?php echo $d['keterangan_peringatan']; ?>" required>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Image</label>
													<div class="col-sm-10">
														<input type="file" class="form-control-file" name="gambar_peminjam" accept="image/*" >
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
											<button type="submit" class="btn btn-primary">Simpan</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						</div>
						</div>			
					</td>
				  </tr>
				  <?php 
	} 
	?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
			</div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
	</div>
	
		<?php 
		include 'footer.php';

		?>
	



	