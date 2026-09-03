

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
                <h3 class="card-title">Master Jabatan</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_jabatan FROM jabatan ORDER BY id_jabatan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_jabatan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'JBT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'JBT001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_jabatan.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_jabatan" id="kode_jabatan" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Jabatan</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="nama_jabatan" id="nama_jabatan" required>
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
                    <th>Jabatan</th>
                  </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select id_jabatan, kode_jabatan, nama_jabatan from jabatan";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					  <td><?php echo $no++; ?></td>
					  <td><?php echo $d['kode_jabatan']; ?></td>
					  <td><?php echo $d['nama_jabatan']; ?></td>
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
								<h5 class="modal-title" id="modalHapus">Hapus Jabatan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_jabatan.php?id_jabatan=<?php echo $d['id_jabatan']; ?>">
									<button type="button" class="btn btn-danger p-2">Yes</button>
								</a>
							</div>
							</div>
						</div>
						</div>

						
						<button type="button" class="btn btn-block btn-xs btn-outline-success mt-2 " data-toggle="modal" data-target="#Edit<?= $no ?>">
						Edit
						</button>

						<div class="modal fade" id="Edit<?= $no ?>" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalEdit">Edit Jabatan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_jabatan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jabatan" value="<?php echo $d['id_jabatan']; ?>">
											<input type="text" class="form-control" name="kode_jabatan" value="<?php echo $d['kode_jabatan'];?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label">Jabatan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_jabatan" value="<?php echo $d['id_jabatan']; ?>">
											<input type="text" class="form-control" name="nama_jabatan" value="<?php echo $d['nama_jabatan']; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_jabatan.php?id_jabatan=<?php echo $d['id_jabatan']; ?>">
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
	



	