

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
                <h3 class="card-title">Transaksi Kelas Siswa</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Kelas Siswa</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_kelassiswa FROM kelas_siswa ORDER BY id_kelassiswa DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_kelassiswa'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'KLSIS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'KLSIS001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_kelassiswa.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_kelassiswa" id="kode_kelassiswa" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_jurusan" id="id_jurusan" required>
                                                    <option value="" disabled selected>Pilih Jurusan</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_jurusan = mysqli_query($koneksi, "SELECT id_jurusan, nama_jurusan FROM jurusan");
                                                    while ($jurusan = mysqli_fetch_array($query_jurusan)) {
                                                        echo '<option value="' . $jurusan['id_jurusan'] . '">' . $jurusan['nama_jurusan'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelas" id="id_kelas" required>
                                                    <option value="" disabled selected>Pilih Kelas</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_kelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
                                                    while ($kelas = mysqli_fetch_array($query_kelas)) {
                                                        echo '<option value="' . $kelas['id_kelas'] . '">' . $kelas['nama_kelas'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas Jurusan</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="nama_kelassiswa" id="nama_kelassiswa" required>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas Siswa</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ruangan_kelassiswa" id="ruangan_kelassiswa" required>
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
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Kelas Jurusan</th>
                    <th>Kelas Siswa</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select ks.id_kelassiswa, ks.kode_kelassiswa, ks.nama_kelassiswa, ks.ruangan_kelassiswa, jr.id_jurusan, jr.singkatan, kl.id_kelas, kl.nama_kelas from kelas_siswa ks join jurusan jr on ks.id_jurusan=jr.id_jurusan join kelas kl on ks.id_kelas=kl.id_kelas order by kode_kelassiswa asc";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_kelassiswa']; ?></td>
					<td><?php echo $d['nama_kelas']; ?></td> 
					<td><?php echo $d['singkatan']; ?></td> 
					<td><?php echo $d['nama_kelassiswa']; ?></td> 
					<td><?php echo $d['ruangan_kelassiswa']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Kelas Siswa</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_kelassiswa.php?id_kelassiswa=<?php echo $d['id_kelassiswa']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Kelas Siswa</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_kelassiswa.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_kelassiswa" value="<?php echo $d['id_kelassiswa']; ?>">
											<input type="text" class="form-control" name="kode_kelassiswa" value="<?php echo $d['kode_kelassiswa']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jurusan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_jurusan" required>
                                                <option value="">Pilih Jurusan</option>
                                                <?php
                                                $query_jurusan = mysqli_query($koneksi, "SELECT id_jurusan, nama_jurusan FROM jurusan");
                                                while ($jurusan = mysqli_fetch_array($query_jurusan)) {
                                                    $selected = ($jurusan['id_jurusan'] == $d['id_jurusan']) ? 'selected' : '';
                                                    echo '<option value="' . $jurusan['id_jurusan'] . '" ' . $selected . '>' . $jurusan['nama_jurusan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Kelas</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_kelas" required>
                                                <option value="">Pilih Kelas</option>
                                                <?php
                                                $query_kelas = mysqli_query($koneksi, "SELECT id_kelas, nama_kelas FROM kelas");
                                                while ($kelas = mysqli_fetch_array($query_kelas)) {
                                                    $selected = ($kelas['id_kelas'] == $d['id_kelas']) ? 'selected' : '';
                                                    echo '<option value="' . $kelas['id_kelas'] . '" ' . $selected . '>' . $kelas['nama_kelas'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kelas Jurusan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_kelassiswa" value="<?php echo $d['id_kelassiswa']; ?>">
											<input type="number" class="form-control" name="nama_kelassiswa" value="<?php echo $d['nama_kelassiswa']; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kelas Siswa</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_kelassiswa" value="<?php echo $d['id_kelassiswa']; ?>">
											<input type="text" class="form-control" name="ruangan_kelassiswa" value="<?php echo $d['ruangan_kelassiswa']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_kelassiswa.php?id_kelassiswa=<?php echo $d['id_kelassiswa']; ?>">
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
	



	