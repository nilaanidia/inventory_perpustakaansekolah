

  <!-- Navbar -->
  <?php 
  include 'koneksi.php';
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
                <h3 class="card-title">Transaksi Siswa</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_siswa FROM siswa ORDER BY id_siswa DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_siswa'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'SIS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'SIS001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_siswa.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_siswa" id="kode_siswa" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">User Peminjam</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_peminjam" id="id_peminjam" required>
                                                    <option value="" disabled selected>Pilih Username Peminjam</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam where status_peminjam='tidak_aktif' and role_peminjam='siswa'");
                                                    while ($peminjam = mysqli_fetch_array($query_peminjam)) {
                                                        echo '<option value="' . $peminjam['id_peminjam'] . '">' . $peminjam['username_peminjam'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelassiswa" id="id_kelassiswa" required>
                                                    <option value="" disabled selected>Pilih Kelas</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_kelassiswa = mysqli_query($koneksi, "SELECT id_kelassiswa, concat(k.NAMA_KELAS,' ',j.singkatan, ' ', ks.NAMA_KELASSISWA) as kls_siswa FROM kelas_siswa ks join kelas k on (ks.ID_KELAS=k.ID_KELAS) join jurusan j on (ks.ID_JURUSAN=j.ID_JURUSAN)");
                                                    while ($kelassiswa = mysqli_fetch_array($query_kelassiswa)) {
                                                        echo '<option value="' . $kelassiswa['id_kelassiswa'] . '">' . $kelassiswa['kls_siswa'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">NIS</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nis" id="nis" required>
                                        </div>
                                     </div>
									 <div class="form-group row">
											<label class="col-sm-2 col-form-label">Nama Siswa</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_siswa" id="nama_siswa" required>
											</div>
									</div>
									<div class="form-group row">
											<label class="col-sm-2 col-form-label">Alamat Siswa</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="alamat_siswa" id="alamat_siswa" required>
											</div>
									</div>
									<div class="form-group row">
											<label class="col-sm-2 col-form-label">Angkatan Siswa</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="angkatan_siswa" id="angkatan_siswa" required>
											</div>
									
									</div>
									<div class="form-group row">
											<label class="col-sm-2 col-form-label">Keterengan Siswa</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="keterangan_siswa" id="keterangan_siswa" required>
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
                    <th>Peminjam</th>
                    <th>Kelas</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
					<th>Alamat Siswa</th>
					<th>Angkatan Siswa</th>
					<th>Keterangan Siswa</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "SELECT s.id_siswa, s.kode_siswa, s.nis, s.nama_siswa, s.alamat_siswa, s.angkatan_siswa, s.keterangan_siswa, pj.username_peminjam, concat(k.NAMA_KELAS,' ',j.singkatan, ' ', ks.NAMA_KELASSISWA) as kls_siswa FROM siswa s join kelas_siswa ks on (s.ID_KELASSISWA=ks.ID_KELASSISWA) join kelas k on (ks.ID_KELAS=k.ID_KELAS) join jurusan j on (ks.ID_JURUSAN=j.ID_JURUSAN) join peminjam pj on s.id_peminjam=pj.id_peminjam";
					$data = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                             while ($d = mysqli_fetch_array($data)) { 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_siswa']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td>
					<td><?php echo $d['kls_siswa']; ?></td>
					<td><?php echo $d['nis']; ?></td> 
                    <td><?php echo $d['nama_siswa']; ?></td> 
					<td><?php echo $d['alamat_siswa']; ?></td> 
                    <td><?php echo $d['angkatan_siswa']; ?></td> 
					<td><?php echo $d['keterangan_siswa']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Siswa</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_siswa.php?id_siswa=<?php echo $d['id_siswa']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Siswa</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_siswa.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_siswa" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="kode_siswa" value="<?php echo $d['kode_siswa']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label">User Peminjam</label>
										<div class="col-sm-10">
											<select class="form-control" name="id_peminjam" required>
												<option value="">Pilih Peminjam</option>
												<?php
												$query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam where status_peminjam='tidak_aktif' and role_peminjam='siswa'");
												while ($peminjam = mysqli_fetch_array($query_peminjam)) {
													$selected = ($peminjam['id_peminjam'] == $d['id_peminjam']) ? 'selected' : '';
													echo '<option value="' . $peminjam['id_peminjam'] . '" ' . $selected . '>' . $peminjam['username_peminjam'] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas Siswa</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelassiswa" id="id_kelassiswa" required>
                                                    <option value="">Pilih Kelas Siswa</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_kelassiswa = mysqli_query($koneksi, "SELECT id_kelassiswa, nama_kelassiswa FROM kelas_siswa");
                                                    while ($kelassiswa = mysqli_fetch_array($query_kelassiswa)) {
                                                        $selected = ($kelassiswa['id_kelassiswa'] == $d['id_kelassiswa']) ? 'selected' : '';
														echo '<option value="' . $kelassiswa['id_kelassiswa'] . '" ' . $selected . '>' . $kelassiswa['nama_kelassiswa'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
											</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">NIS</label>
										<div class="col-sm-10">
											<input type="hidden" name="nis" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="nis" value="<?php echo $d['nis']; ?>">
										</div>
									</div>								
								<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Nama Siswa</label>
										<div class="col-sm-10">
											<input type="hidden" name="nama_siswa" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="nama_siswa" value="<?php echo $d['nama_siswa']; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Alamat Siswa</label>
										<div class="col-sm-10">
											<input type="hidden" name="alamat_siswa" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="alamat_siswa" value="<?php echo $d['alamat_siswa']; ?>">
										</div>			
							</div>
							<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Angkatan Siswa</label>
										<div class="col-sm-10">
											<input type="hidden" name="angkatan_siswa" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="angkatan_siswa" value="<?php echo $d['angkatan_siswa']; ?>">
										</div>
										</div>
										<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Keterangan Siswa</label>
										<div class="col-sm-10">
											<input type="hidden" name="keterangan_siswa" value="<?php echo $d['id_siswa']; ?>">
											<input type="text" class="form-control" name="keterangan_siswa" value="<?php echo $d['keterangan_siswa']; ?>">
										</div>
										</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_siswa.php?id_siswa=<?php echo $d['id_siswa']; ?>">
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
	



	