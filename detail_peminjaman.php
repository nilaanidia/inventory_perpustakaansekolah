

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
                <h3 class="card-title">Detail peminjaman</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Detail Peminjaman</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_dtlpeminjaman FROM detail_peminjaman ORDER BY id_detail_peminjaman DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_dtlpeminjaman'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'DTLPEM' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'DTLPEM001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_dtlpeminjaman.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_dtlpeminjaman" id="kode_dtlpeminjaman" value="<?php echo $newCode; ?>" readonly>
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
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_peminjaman" id="id_peminjaman" required>
                                                    <option value="" disabled selected>Pilih Tanggal Peminjaman</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_peminjaman = mysqli_query($koneksi, "SELECT id_peminjaman, tanggal_peminjaman FROM peminjaman");
                                                    while ($peminjaman = mysqli_fetch_array($query_peminjaman)) {
                                                        echo '<option value="' . $peminjaman['id_peminjaman'] . '">' . $peminjaman['tanggal_peminjaman'] . '</option>';
                                                    }
                                                    ?>
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
                    <th>Peralatan</th>
                    <th>Tanggal Peminjaman</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select dpj.id_detail_peminjaman, dpj.kode_dtlpeminjaman, pj.tanggal_peminjaman, pj.id_peminjaman, pr.nama_peralatan, pr.id_peralatan from detail_peminjaman dpj join peminjaman pj on dpj.id_peminjaman=pj.id_peminjaman join peralatan pr on dpj.id_peralatan=pr.id_peralatan";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					  <td><?php echo $no++; ?></td>
					  <td><?php echo $d['kode_dtlpeminjaman']; ?></td> 
					  <td><?php echo $d['nama_peralatan']; ?></td> 
					<td><?php echo $d['tanggal_peminjaman']; ?></td>
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
								<h5 class="modal-title" id="modalHapus">Hapus Detail peminjaman</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_dtlpeminjaman.php?id_detail_peminjaman=<?php echo $d['id_detail_peminjaman']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Detail peminjaman</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_dtlpeminjaman.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_detail_peminjaman" value="<?php echo $d['id_detail_peminjaman']; ?>">
											<input type="text" class="form-control" name="kode_dtlpeminjaman" value="<?php echo $d['kode_dtlpeminjaman']; ?>" readonly>
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
                                        <label class="col-sm-2 col-form-label">Tanggal peminjaman</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_peminjaman" required>
                                                <option value="">Pilih Tanggal peminjaman</option>
                                                <?php
                                                $query_peminjaman = mysqli_query($koneksi, "SELECT id_peminjaman, tanggal_peminjaman FROM peminjaman");
                                                while ($peminjaman = mysqli_fetch_array($query_peminjaman)) {
                                                    $selected = ($peminjaman['id_peminjaman'] == $d['id_peminjaman']) ? 'selected' : '';
                                                    echo '<option value="' . $peminjaman['id_peminjaman'] . '" ' . $selected . '>' . $peminjaman['tanggal_peminjaman'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_dtlpeminjaman.php?id_detail_peminjaman=<?php echo $d['id_detail_peminjaman']; ?>">
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
	



	