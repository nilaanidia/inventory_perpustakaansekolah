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
                <h3 class="card-title">Transaksi Peminjaman Siswa</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman Siswa</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_peminjaman_siswa FROM peminjaman_siswa ORDER BY id_peminjaman_siswa DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_peminjaman_siswa'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PMJMN_SIS' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PMJMN_SIS001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_peminjaman_siswa.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_peminjaman_siswa" id="kode_peminjaman_siswa" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Id Peminjam</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_peminjam" id="id_peminjam" required>
                                                    <option value="" disabled selected>Pilih Username Peminjam</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam");
                                                    while ($peminjam = mysqli_fetch_array($query_peminjam)) {
                                                        echo '<option value="' . $peminjam['id_peminjam'] . '">' . $peminjam['username_peminjam'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Mata Pelajaran</label>
                                            <div class="col-sm-10">
                                                <input type="type" class="form-control" name="mata_pelajaran" id="mata_pelajaran" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Guru Pengajar</label>
                                            <div class="col-sm-10">
                                                <input type="type" class="form-control" name="guru_pengajar" id="guru_pengajar" required>
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
                    <th>Peminjam</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengajar</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pmjms.id_peminjaman_siswa, pmjms.kode_peminjaman_siswa, pmjms.guru_pengajar, pmjms.mata_pelajaran, pj.id_peminjam, pj.username_peminjam from peminjaman_siswa pmjms join peminjam pj on pmjms.id_peminjam=pj.id_peminjam order by kode_peminjaman_siswa asc";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_peminjaman_siswa']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td> 
					<td><?php echo $d['mata_pelajaran']; ?></td> 
					<td><?php echo $d['guru_pengajar']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Peminjaman Siswa</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_peminjaman_siswa.php?id_peminjaman_siswa=<?php echo $d['id_peminjaman_siswa']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Peminjaman Siswa</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_peminjaman_siswa.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjaman_siswa" value="<?php echo $d['id_peminjaman_siswa']; ?>">
											<input type="text" class="form-control" name="kode_peminjaman_siswa" value="<?php echo $d['kode_peminjaman_siswa']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Peminjam</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_peminjam" required>
                                                <option value="">Pilih Peminjam</option>
                                                <?php
                                                $query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam");
                                                while ($peminjam = mysqli_fetch_array($query_peminjam)) {
                                                    $selected = ($peminjam['id_peminjam'] == $d['id_peminjam']) ? 'selected' : '';
                                                    echo '<option value="' . $peminjam['id_peminjam'] . '" ' . $selected . '>' . $peminjam['username_peminjam'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Mata Pelajaran</label>
										<div class="col-sm-10">
											<input type="hidden" name="mata_pelajaran" value="<?php echo $d['id_peminjaman_siswa']; ?>">
											<input type="text" class="form-control" name="mata_pelajaran" value="<?php echo $d['mata_pelajaran']; ?>">
										</div>
									</div>
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label">Guru Pengajar</label>
										<div class="col-sm-10">
											<input type="hidden" name="guru_pengajar" value="<?php echo $d['id_peminjaman_siswa']; ?>">
											<input type="text" class="form-control" name="guru_pengajar" value="<?php echo $d['guru_pengajar']; ?>">
										</div>
                                        
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_peminjaman_siswa.php?id_peminjaman_siswa=<?php echo $d['id_peminjaman_siswa']; ?>">
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
	



	