

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
                <h3 class="card-title">Transaksi guru</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah guru</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_guru FROM guru ORDER BY id_guru DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_guru'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'GR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'GR001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_guru.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_guru" id="kode_guru" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nik</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nik" id="nik" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Guru</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_guru" id="nama_guru" required>
                                            </div>
                                        </div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Username</label>
											<div class="col-sm-10">
												<select class="form-control" name="id_peminjam" id="id_peminjam" required>
													<option value="" disabled selected>Pilih Username</option>
													<?php
													include 'koneksi.php';
													// Menampilkan username yang belum digunakan
													$query_guru = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam WHERE status_peminjam = 'tidak_aktif' and role_peminjam = 'guru'");
													while ($guru = mysqli_fetch_array($query_guru)) {
														echo '<option value="' . $guru['id_peminjam'] . '">' . $guru['username_peminjam'] . '</option>';
													}
													?>
												</select>
											</div>
										</div>

										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jabatan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_jabatan" id="id_jabatan" required>
                                                    <option value="" disabled selected>Pilih Jabatan</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_guru = mysqli_query($koneksi, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                                                    while ($guru = mysqli_fetch_array($query_guru)) {
                                                        echo '<option value="' . $guru['id_jabatan'] . '">' . $guru['nama_jabatan'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Alamat Guru</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="alamat_guru" id="alamat_guru" required>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Lahir Guru</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tanggallahir_guru" id="tanggallahir_guru" required>
                                            </div>
                                        </div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearForm()">Batal</button>
										<button type="submit" value="submit" class="btn btn-primary">Simpan</button>
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
                    <th>NIK</th>
                    <th>Nama Guru</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Alamat Guru</th>
                    <th>Tanggal Lahir Guru</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pj.id_peminjam, jb.id_jabatan, pj.username_peminjam, jb.nama_jabatan, gr.id_guru, gr.kode_guru, gr.nik, gr.nama_guru, gr.alamat_guru, gr.tanggallahir_guru from guru gr join jabatan jb on gr.id_jabatan = jb.id_jabatan join peminjam pj on gr.id_peminjam = pj.id_peminjam order by gr.kode_guru asc; ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_guru']; ?></td>
					<td><?php echo $d['nik']; ?></td>
					<td><?php echo $d['nama_guru']; ?></td> 
					<td><?php echo $d['username_peminjam']; ?></td> 
					<td><?php echo $d['nama_jabatan']; ?></td> 
					<td><?php echo $d['alamat_guru']; ?></td> 
					<td><?php echo $d['tanggallahir_guru']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus guru</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_guru.php?id_guru=<?php echo $d['id_guru']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit guru</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_guru.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_guru" value="<?php echo $d['id_guru']; ?>">
											<input type="text" class="form-control" name="kode_guru" value="<?php echo $d['kode_guru']; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">NIK</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_guru" value="<?php echo $d['id_guru']; ?>">
											<input type="text" class="form-control" name="nik" value="<?php echo $d['nik']; ?>" >
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Nama Guru</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_guru" value="<?php echo $d['id_guru']; ?>">
											<input type="text" class="form-control" name="nama_guru" value="<?php echo $d['nama_guru']; ?>" >
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Peminjam</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_peminjam">
                                                <option value="<?php echo $d['username_peminjam']; ?>">Pilih Peminjam</option>
                                                <?php
                                                $query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam WHERE status_peminjam = 'tidak_aktif' and role_peminjam = 'guru'");
                                                while ($peminjam = mysqli_fetch_array($query_peminjam)) {
                                                    $selected = ($peminjam['id_peminjam'] == $d['id_peminjam']) ? 'selected' : '';
                                                    echo '<option value="' . $peminjam['id_peminjam'] . '" ' . $selected . '>' . $peminjam['username_peminjam'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Jabatan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_jabatan" required>
                                                <option value="<?php echo $d['nama_jabatan']; ?>">Pilih Jabatan</option>
                                                <?php
                                                $query_jabatan = mysqli_query($koneksi, "SELECT id_jabatan, nama_jabatan FROM jabatan");
                                                while ($jabatan = mysqli_fetch_array($query_jabatan)) {
                                                    $selected = ($jabatan['id_jabatan'] == $d['id_jabatan']) ? 'selected' : '';
                                                    echo '<option value="' . $jabatan['id_jabatan'] . '" ' . $selected . '>' . $jabatan['nama_jabatan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Alamat Guru</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_guru" value="<?php echo $d['id_guru']; ?>">
											<input type="text" class="form-control" name="alamat_guru" value="<?php echo $d['alamat_guru']; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Tanggal Lahir Guru</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_guru" value="<?php echo $d['id_guru']; ?>">
											<input type="date" class="form-control" name="tanggallahir_guru" value="<?php echo $d['tanggallahir_guru']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_guru.php?id_guru=<?php echo $d['id_guru']; ?>">
									<button type="submit" class="btn btn-primary">Simpan</button>
								</a>
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
	



	