


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
                <h3 class="card-title">Master Jurusan</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_jurusan FROM jurusan ORDER BY id_jurusan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_jurusan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'JRSN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'JRSN001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_aksi.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_jurusan" id="kode_jurusan" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Jurusan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" required>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Singkatan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="singkatan" id="singkatan" required>
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
					  <th>Jurusan</th>
					  <th>Singkatan</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select id_jurusan, kode_jurusan, nama_jurusan, singkatan from jurusan";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					  <td><?php echo $no++; ?></td>
					  <td><?php echo $d['kode_jurusan']; ?></td>
					  <td><?php echo $d['nama_jurusan']; ?></td>
					  <td><?php echo $d['singkatan']; ?></td>
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
								<h5 class="modal-title" id="modalHapus">Hapus Jurusan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus.php?id_jurusan=<?php echo $d['id_jurusan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Jurusan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jurusan" value="<?php echo $d['id_jurusan']; ?>">
											<input type="text" class="form-control" name="kode_jurusan" value="<?php echo $d['kode_jurusan']; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Jurusan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jurusan" value="<?php echo $d['id_jurusan']; ?>">
											<input type="text" class="form-control" name="nama_jurusan" value="<?php echo $d['nama_jurusan']; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Singkatan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jurusan" value="<?php echo $d['id_jurusan']; ?>">
											<input type="text" class="form-control" name="singkatan" value="<?php echo $d['singkatan']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update.php?id_jurusan=<?php echo $d['id_jurusan']; ?>">
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
	



	