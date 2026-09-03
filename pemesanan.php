

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
                <h3 class="card-title">Transaksi Pemesanan</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Pemesanan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_pemesanan FROM pemesanan ORDER BY id_pemesanan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_pemesanan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PMSN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PMSN001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_pemesanan.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_pemesanan" id="kode_pemesanan" value="<?php echo $newCode; ?>" readonly>
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
											<label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="tanggal_pemesanan" id="tanggal_pemesanan" required>
											</div>
										</div>
                                        <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Status Pemesanan</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="status_pemesanan" id="status_pemesanan" required>
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
                    <th>Tanggal Pemesanan</th>
                    <th>Status Pemesanan</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pj.username_peminjam, pmsn.id_pemesanan, pmsn.kode_pemesanan, pj.id_peminjam,pmsn.kode_pemesanan, pmsn.tanggal_pemesanan, pmsn.status_pemesanan from pemesanan pmsn join peminjam pj on pmsn.id_peminjam=pj.id_peminjam ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_pemesanan']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td> 
                    <td><?php echo $d['tanggal_pemesanan']; ?></td> 
                    <td><?php echo $d['status_pemesanan']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Pemesanan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_pemesanan.php?id_pemesanan=<?php echo $d['id_pemesanan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Pemesanan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_pemesanan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_pemesanan" value="<?php echo $d['id_pemesanan']; ?>">
											<input type="text" class="form-control" name="kode_pemesanan" value="<?php echo $d['kode_pemesanan']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label">User Peminjam</label>
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
										<label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_pemesanan" value="<?php echo $d['id_pemesanan']; ?>">
											<input type="date" class="form-control" name="tanggal_pemesanan" value="<?php echo $d['tanggal_pemesanan']; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Status Pemesanan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_pemesanan" value="<?php echo $d['id_pemesanan']; ?>">
											<input type="text" class="form-control" name="status_pemesanan" value="<?php echo $d['status_pemesanan']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_pemesanan.php?id_pemesanan=<?php echo $d['id_pemesanan']; ?>">
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
	



	