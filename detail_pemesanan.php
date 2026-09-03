

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
                <h3 class="card-title">Detail Pemesanan </h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Detail Pemesanan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_dtlpemesanan FROM detail_pemesanan ORDER BY id_detail_pemesanan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_dtlpemesanan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'DTLPES' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'DTLPES001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_dtlpemesanan.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_dtlpemesanan" id="kode_dtlpemesanan" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Tanggal Pemesanan</label>
											<div class="col-sm-10">
												<select class="form-control" name="id_pemesanan" id="id_pemesanan" required>
													<option value="" disabled selected>Pilih Tanggal Pemesanan</option>
													<?php
													include 'koneksi.php';
													$query_guru = mysqli_query($koneksi, "SELECT id_pemesanan, tanggal_pemesanan FROM pemesanan");
													while ($guru = mysqli_fetch_array($query_guru)) {
														echo '<option value="' . $guru['id_pemesanan'] . '">' . $guru['tanggal_pemesanan'] . '</option>';
													}
													?>
												</select>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Peralatan</label>
											<div class="col-sm-10">
												<select class="form-control" name="id_peralatan" id="id_peralatan" required>
													<option value="" disabled selected>Pilih Peralatan</option>
													<?php
													include 'koneksi.php';
													$query_peralatan = mysqli_query($koneksi, "SELECT id_peralatan, nama_peralatan FROM peralatan");
													while ($peralatan = mysqli_fetch_array($query_peralatan)) {
														echo '<option value="' . $peralatan['id_peralatan'] . '">' . $peralatan['nama_peralatan'] . '</option>';
													}
													?>
												</select>
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
                    <th>Peralatan</th>
                    <th>Tanggal Pemesanan</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select dps.id_detail_pemesanan, dps.kode_dtlpemesanan, ps.id_pemesanan, pr.id_peralatan, ps.tanggal_pemesanan, pr.nama_peralatan from detail_pemesanan dps join pemesanan ps on dps.id_pemesanan=ps.id_pemesanan join peralatan pr on dps.id_peralatan=pr.id_peralatan ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					  <td><?php echo $no++; ?></td>
					  <td><?php echo $d['kode_dtlpemesanan']; ?></td> 
					  <td><?php echo $d['nama_peralatan']; ?></td> 
					<td><?php echo $d['tanggal_pemesanan']; ?></td>
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
								<h5 class="modal-title" id="modalHapus">Hapus Detail pemesanan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_dtlpemesanan.php?id_detail_pemesanan=<?php echo $d['id_detail_pemesanan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Detail pemesanan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_dtlpemesanan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_detail_pemesanan" value="<?php echo $d['id_detail_pemesanan']; ?>">
											<input type="text" class="form-control" name="kode_dtlpemesanan" value="<?php echo $d['kode_dtlpemesanan']; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Peralatan</label>
										<div class="col-sm-10">
											<select class="form-control" name="id_peralatan" required>
												<option value="">Pilih Peralatan</option>
												<?php
												$query_peralatan = mysqli_query($koneksi, "SELECT id_peralatan, nama_peralatan FROM peralatan");
												while ($peralatan = mysqli_fetch_array($query_peralatan)) {
													$selected = ($peralatan['id_peralatan'] == $d['id_peralatan']) ? 'selected' : '';
													echo '<option value="' . $peralatan['id_peralatan'] . '" ' . $selected . '>' . $peralatan['nama_peralatan'] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal pemesanan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_pemesanan" required>
                                                <option value="">Pilih Tanggal pemesanan</option>
                                                <?php
                                                $query_pemesanan = mysqli_query($koneksi, "SELECT id_pemesanan, tanggal_pemesanan FROM pemesanan");
                                                while ($pemesanan = mysqli_fetch_array($query_pemesanan)) {
                                                    $selected = ($pemesanan['id_pemesanan'] == $d['id_pemesanan']) ? 'selected' : '';
                                                    echo '<option value="' . $pemesanan['id_pemesanan'] . '" ' . $selected . '>' . $pemesanan['tanggal_pemesanan'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_dtlpemesanan.php?id_detail_pemesanan=<?php echo $d['id_detail_pemesanan']; ?>">
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
	



	