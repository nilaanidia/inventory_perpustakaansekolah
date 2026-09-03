

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
                <h3 class="card-title">Transaksi Peminjaman</h3>
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
								<h5 class="modal-title" id="exampleModalLabel">Tambah Peminjaman</h5>
							</div>
							<div class="modal-body">
								<?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_peminjaman FROM peminjaman ORDER BY id_peminjaman DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);

								if ($row) {
									$lastCode = $row['kode_peminjaman'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;

									$newCode = 'PMJMN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
									$newCode = 'PMJMN001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_peminjaman.php">
									<div class="card-body">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="kode_peminjaman" id="kode_peminjaman" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
										<div class="form-group row">
                                            <label class="col-sm-2 col-form-label">User Peminjam</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_peminjam" id="id_peminjam" onchange="getGuru(this.value)" required>
                                                    <option value="" disabled selected>Pilih Username Peminjam</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_peminjam = mysqli_query($koneksi, "SELECT id_peminjam, username_peminjam FROM peminjam WHERE role_peminjam = 'guru'");
                                                    while ($peminjam = mysqli_fetch_array($query_peminjam)) {
                                                        echo '<option value="' . $peminjam['id_peminjam'] . '">' . $peminjam['username_peminjam'] . '</option>';
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
											<label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="tanggal_peminjaman" id="tanggal_peminjaman" required>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Tanggal Kembali</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="tanggal_kembali" id="tanggal_kembali" required>
											</div>
										</div>
                                        <div class="form-group row">
											<label class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="tanggal_pengembalian" id="tanggal_pengembalian" required>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Denda</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_denda" id="id_denda" required>
                                                    <option value="" disabled selected>Pilih Denda</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_denda = mysqli_query($koneksi, "SELECT id_denda, denda FROM denda");
                                                    while ($denda = mysqli_fetch_array($query_denda)) {
                                                        echo '<option value="' . $denda['id_denda'] . '">' . $denda['denda'] . '</option>';
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
                    <th>Peminjam</th>
                    <th>Guru</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Kembali</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Denda</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select dd.id_denda, dd.denda, gr.id_guru, gr.nama_guru, pj.id_peminjam, pj.username_peminjam, pjmn.id_peminjaman, pjmn.kode_peminjaman, pjmn.tanggal_peminjaman, pjmn.tanggal_pengembalian, pjmn.tanggal_kembali from peminjaman pjmn join peminjam pj on pjmn.id_peminjam=pj.id_peminjam join guru gr on pjmn.id_guru=gr.id_guru join denda dd on pjmn.id_denda=dd.id_denda order by pjmn.kode_peminjaman asc";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_peminjaman']; ?></td>
					<td><?php echo $d['username_peminjam']; ?></td> 
                    <td><?php echo $d['nama_guru']; ?></td> 
                    <td><?php echo $d['tanggal_peminjaman']; ?></td> 
                    <td><?php echo $d['tanggal_kembali']; ?></td> 
                    <td><?php echo $d['tanggal_pengembalian']; ?></td> 
                    <td><?php echo $d['denda']; ?></td> 
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
								<h5 class="modal-title" id="modalHapus">Hapus peminjaman</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_peminjaman.php?id_peminjaman=<?php echo $d['id_peminjaman']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit peminjaman</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_peminjaman.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peminjaman" value="<?php echo $d['id_peminjaman']; ?>">
											<input type="text" class="form-control" name="kode_peminjaman" value="<?php echo $d['kode_peminjaman']; ?>" readonly>
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
                                        <label class="col-sm-2 col-form-label">Tanggal Peminjaman</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_peminjaman" value="<?php echo $d['id_peminjaman']; ?>">
                                            <input type="date" class="form-control" name="tanggal_peminjaman" value="<?php echo $d['tanggal_peminjaman']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Kembali</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_peminjaman" value="<?php echo $d['id_peminjaman']; ?>">
                                            <input type="date" class="form-control" name="tanggal_kembali" value="<?php echo $d['tanggal_kembali']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_peminjaman" value="<?php echo $d['id_peminjaman']; ?>">
                                            <input type="date" class="form-control" name="tanggal_pengembalian" value="<?php echo $d['tanggal_pengembalian']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Denda</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_denda" required>
                                                <option value="">Pilih Denda</option>
                                                <?php
                                                $query_denda = mysqli_query($koneksi, "SELECT id_denda, denda FROM denda");
                                                while ($denda = mysqli_fetch_array($query_denda)) {
                                                    $selected = ($denda['id_denda'] == $d['id_denda']) ? 'selected' : '';
                                                    echo '<option value="' . $denda['id_denda'] . '" ' . $selected . '>' . $denda['denda'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_peminjaman.php?id_peminjaman=<?php echo $d['id_peminjaman']; ?>">
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
	
    <script>
        function getGuru(idPeminjam) {
    if (idPeminjam) {
        fetch(`get_guru.php?id_peminjam=${idPeminjam}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('id_guru').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('id_guru').innerHTML = '<option value="" disabled selected>Pilih Guru</option>';
    }
}

    </script>



	