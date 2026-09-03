

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
                <h3 class="card-title">Detail Perbaikan</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Detail Perbaikan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_dtlperbaikan FROM detail_perbaikan ORDER BY id_detail_perbaikan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_dtlperbaikan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'DTLPER' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'DTLPER001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_dtlperbaikan.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_dtlperbaikan" id="kode_dtlperbaikan" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Perbaikan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_perbaikan" id="id_perbaikan" required>
                                                    <option value="" disabled selected>Pilih Tanggal Perbaikan</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_perbaikan = mysqli_query($koneksi, "SELECT id_perbaikan, tanggal_perbaikan FROM perbaikan");
                                                    while ($perbaikan = mysqli_fetch_array($query_perbaikan)) {
                                                        echo '<option value="' . $perbaikan['id_perbaikan'] . '">' . $perbaikan['tanggal_perbaikan'] . '</option>';
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
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Keterangan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="keterangan" id="keterangan" required>
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
                    <th>Tanggal Perbaikan</th>
                    <th>Peralatan</th>
                    <th>Keterangan</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select dp.id_detail_perbaikan, dp.kode_dtlperbaikan, dp.keterangan, pb.id_perbaikan, pb.tanggal_perbaikan, pr.id_peralatan, pr.nama_peralatan from detail_perbaikan dp join perbaikan pb on dp.id_perbaikan=pb.id_perbaikan join peralatan pr on dp.id_peralatan=pr.id_peralatan order by kode_dtlperbaikan asc";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_dtlperbaikan']; ?></td>
					<td><?php echo $d['tanggal_perbaikan']; ?></td> 
					<td><?php echo $d['nama_peralatan']; ?></td> 
					<td><?php echo $d['keterangan']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus Detail Perbaikan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_dtlperbaikan.php?id_detail_perbaikan=<?php echo $d['id_detail_perbaikan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Detail Perbaikan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_dtlperbaikan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_detail_perbaikan" value="<?php echo $d['id_detail_perbaikan']; ?>">
											<input type="text" class="form-control" name="kode_dtlperbaikan" value="<?php echo $d['kode_dtlperbaikan']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Perbaikan</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_perbaikan" required>
                                                <option value="">Pilih Tanggal Perbaikan</option>
                                                <?php
                                                $query_perbaikan = mysqli_query($koneksi, "SELECT id_perbaikan, tanggal_perbaikan FROM perbaikan");
                                                while ($perbaikan = mysqli_fetch_array($query_perbaikan)) {
                                                    $selected = ($perbaikan['id_perbaikan'] == $d['id_perbaikan']) ? 'selected' : '';
                                                    echo '<option value="' . $perbaikan['id_perbaikan'] . '" ' . $selected . '>' . $perbaikan['tanggal_perbaikan'] . '</option>';
                                                }
                                                ?>
                                            </select>
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
										<label class="col-sm-2 col-form-label text-nowrap">Keterangan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_detail_perbaikan" value="<?php echo $d['id_detail_perbaikan']; ?>">
											<input type="text" class="form-control" name="keterangan" value="<?php echo $d['keterangan']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_dtlperbaikan.php?id_detail_perbaikan=<?php echo $d['id_detail_perbaikan']; ?>">
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
	



	