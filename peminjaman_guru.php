

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
                <h3 class="card-title">Transaksi Peminjaman Guru</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman Guru</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_peminjaman_guru FROM peminjaman_guru ORDER BY id_peminjaman_guru DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_peminjaman_guru'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PMJMN_GR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PMJMN_GR001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_peminjaman_guru.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_peminjaman_guru" id="kode_peminjaman_guru" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">User Peminjam</label>
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
                                            <label class="col-sm-2 col-form-label">Keterangan Peminjam</label>
                                            <div class="col-sm-10">
                                                <input type="type" class="form-control" name="keterangan_peminjaman" id="keterangan_peminjaman" required>
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
                    <th>Keterangan Peminjaman</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pmjmn.id_peminjaman_guru, pmjmn.kode_peminjaman_guru, pmjmn.keterangan_peminjaman, pj.id_peminjam, pj.username_peminjam from peminjaman_guru pmjmn join peminjam pj on pmjmn.id_peminjam=pj.id_peminjam ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_peminjaman_guru']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td> 
					<td><?php echo $d['keterangan_peminjaman']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Peminjaman Guru</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_peminjaman_guru.php?id_peminjaman_guru=<?php echo $d['id_peminjaman_guru']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Peminjaman Guru</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_peminjaman_guru.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjaman_guru" value="<?php echo $d['id_peminjaman_guru']; ?>">
											<input type="text" class="form-control" name="kode_peminjaman_guru" value="<?php echo $d['kode_peminjaman_guru']; ?>" readonly>
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
										<label class="col-sm-2 col-form-label">Keterangan Peminjaman</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjaman_guru" value="<?php echo $d['id_peminjaman_guru']; ?>">
											<input type="text" class="form-control" name="keterangan_peminjaman" value="<?php echo $d['keterangan_peminjaman']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_peminjaman_guru.php?id_peminjaman_guru=<?php echo $d['id_peminjaman_guru']; ?>">
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
	



	