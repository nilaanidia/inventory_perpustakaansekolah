

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
                <h3 class="card-title">Transaksi Perbaikan</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah perbaikan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_perbaikan FROM perbaikan ORDER BY id_perbaikan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_perbaikan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PRBK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PRBK001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_perbaikan.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_perbaikan" id="kode_perbaikan" value="<?php echo $newCode; ?>" readonly>
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
                                            <label class="col-sm-2 col-form-label">Tanggal Perbaikan</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tanggal_perbaikan" id="tanggal_perbaikan" required>
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
                    <th>Nama Guru</th>
                    <th>Tanggal Perbaikan</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pbr.id_perbaikan, pbr.kode_perbaikan, pbr.tanggal_perbaikan, gr.id_guru ,gr.nama_guru from perbaikan pbr join guru gr on pbr.id_guru=gr.id_guru ";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_perbaikan']; ?></td>
					<td><?php echo $d['nama_guru']; ?></td> 
					<td><?php echo $d['tanggal_perbaikan']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus perbaikan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_perbaikan.php?id_perbaikan=<?php echo $d['id_perbaikan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit perbaikan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_perbaikan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label text-nowrap">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_perbaikan" value="<?php echo $d['id_perbaikan']; ?>">
											<input type="text" class="form-control" name="kode_perbaikan" value="<?php echo $d['kode_perbaikan']; ?>" readonly>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Guru</label>
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
										<label class="col-sm-2 col-form-label text-nowrap">Perbaikan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_perbaikan" value="<?php echo $d['id_perbaikan']; ?>">
											<input type="date" class="form-control" name="tanggal_perbaikan" value="<?php echo $d['tanggal_perbaikan']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_perbaikan.php?id_perbaikan=<?php echo $d['id_perbaikan']; ?>">
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
	



	