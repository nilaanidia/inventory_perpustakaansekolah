

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
                <h3 class="card-title">Transaksi Jadwal</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_jadwal FROM jadwal ORDER BY id_jadwal DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_jadwal'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'JDWL' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'JDWL001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_jadwal.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kelas Siswa</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_kelassiswa" id="id_kelassiswa" required>
                                                    <option value="" disabled selected>Pilih Kelas Siswa</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_kelassiswa = mysqli_query($koneksi, "SELECT id_kelassiswa, nama_kelassiswa FROM kelas_siswa");
                                                    while ($kelassiswa = mysqli_fetch_array($query_kelassiswa)) {
                                                        echo '<option value="' . $kelassiswa['id_kelassiswa'] . '">' . $kelassiswa['nama_kelassiswa'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Pelajaran</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_pelajaran" id="id_pelajaran" required>
                                                    <option value="" disabled selected>Pilih Pelajaran</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_pelajaran = mysqli_query($koneksi, "SELECT id_pelajaran, nama_pelajaran FROM pelajaran");
                                                    while ($pelajaran = mysqli_fetch_array($query_pelajaran)) {
                                                        echo '<option value="' . $pelajaran['id_pelajaran'] . '">' . $pelajaran['nama_pelajaran'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Guru</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_guru" id="id_guru" required>
                                                    <option value="" disabled selected>Pilih Guru</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_guru = mysqli_query($koneksi, "SELECT id_guru, nama_guru FROM guru");
                                                    while ($guru = mysqli_fetch_array($query_guru)) {
                                                        echo '<option value="' . $guru['id_guru'] . '">' . $guru['nama_guru'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Hari</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_hari" id="id_hari" required>
                                                    <option value="" disabled selected>Pilih Pelajaran</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_hari = mysqli_query($koneksi, "SELECT id_hari, nama_hari FROM hari");
                                                    while ($hari = mysqli_fetch_array($query_hari)) {
                                                        echo '<option value="' . $hari['id_hari'] . '">' . $hari['nama_hari'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Jam Masuk</label>
											<div class="col-sm-10">
												<input type="time" class="form-control" name="jam_masuk" id="jam_masuk" required>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Jam Keluar</label>
											<div class="col-sm-10">
												<input type="time" class="form-control" name="jam_keluar" id="jam_keluar" required>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Semester</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="semester" id="semester" required>
                                                    <option value="" disabled selected>Pilih Semester</option>
                                                    <option value="Ganjil" >Ganjil</option>
                                                    <option value="Genap" >Genap</option>
                                                </select>
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
                    <th>Kelas Siswa</th>
                    <th>Pelajaran</th>
                    <th>Guru</th>
                    <th>Hari</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Semester</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select jd.id_jadwal, ks.id_kelassiswa, ks.nama_kelassiswa, hr.id_hari, hr.nama_hari , pl.id_pelajaran, pl.nama_pelajaran, gr.id_guru, gr.nama_guru, jd.jam_masuk, jd.jam_keluar, jd.semester, jd.kode_jadwal from jadwal jd join kelas_siswa ks on jd.id_kelassiswa=ks.id_kelassiswa join pelajaran pl on jd.id_pelajaran=pl.id_pelajaran join guru gr on jd.id_guru=gr.id_guru join hari hr on jd.id_hari=hr.id_hari ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_jadwal']; ?></td>
					<td><?php echo $d['nama_kelassiswa']; ?></td> 
                    <td><?php echo $d['nama_pelajaran']; ?></td> 
                    <td><?php echo $d['nama_guru']; ?></td> 
                    <td><?php echo $d['nama_hari']; ?></td> 
                    <td><?php echo $d['jam_masuk']; ?></td> 
                    <td><?php echo $d['jam_keluar']; ?></td> 
                    <td><?php echo $d['semester']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Jadwal</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_jadwal.php?id_jadwal=<?php echo $d['id_jadwal']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Jadwal</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_jadwal.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jadwal" value="<?php echo $d['id_jadwal']; ?>">
											<input type="text" class="form-control" name="kode_jadwal" value="<?php echo $d['kode_jadwal']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label">Kelas Siswa</label>
										<div class="col-sm-10">
											<select class="form-control" name="id_kelassiswa" required>
												<option value="">Pilih Kelas Siswa</option>
												<?php
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
                                        <label class="col-sm-2 col-form-label">Pelajaran</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pelajaran" required>
                                                <option value="">Pilih Pelajaran</option>
                                                <?php
                                                $query_pelajaran = mysqli_query($koneksi, "SELECT id_pelajaran, nama_pelajaran FROM pelajaran");
                                                while ($pelajaran = mysqli_fetch_array($query_pelajaran)) {
                                                    $selected = ($pelajaran['id_pelajaran'] == $d['id_pelajaran']) ? 'selected' : '';
                                                    echo '<option value="' . $pelajaran['id_pelajaran'] . '" ' . $selected . '>' . $pelajaran['nama_pelajaran'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Guru</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_guru" required>
                                                <option value="">Pilih Guru</option>
                                                <?php
                                                $query_guru = mysqli_query($koneksi, "SELECT id_guru, nama_guru FROM guru");
                                                while ($guru = mysqli_fetch_array($query_guru)) {
                                                    $selected = ($guru['id_guru'] == $d['id_guru']) ? 'selected' : '';
                                                    echo '<option value="' . $guru['id_guru'] . '" ' . $selected . '>' . $guru['nama_guru'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Hari</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_hari" required>
                                                <option value="">Pilih Hari</option>
                                                <?php
                                                $query_hari = mysqli_query($koneksi, "SELECT id_hari, nama_hari FROM hari");
                                                while ($hari = mysqli_fetch_array($query_hari)) {
                                                    $selected = ($hari['id_hari'] == $d['id_hari']) ? 'selected' : '';
                                                    echo '<option value="' . $hari['id_hari'] . '" ' . $selected . '>' . $hari['nama_hari'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jam Masuk</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_jadwal" value="<?php echo $d['id_jadwal']; ?>">
                                            <input type="time" class="form-control" name="jam_masuk" value="<?php echo $d['jam_masuk']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jam Keluar</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_jadwal" value="<?php echo $d['id_jadwal']; ?>">
                                            <input type="time" class="form-control" name="jam_keluar" value="<?php echo $d['jam_keluar']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Semester</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="semester" required>
                                                <option value="">Pilih Semester</option>
                                                <option value="Ganjil" <?= ($d['semester'] === 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                                                <option value="Genap" <?= ($d['semester'] === 'Genap') ? 'selected' : ''; ?>>Genap</option>
                                            </select>
                                        </div>
                                    </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_jadwal.php?id_jadwal=<?php echo $d['id_jadwal']; ?>">
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
	



	