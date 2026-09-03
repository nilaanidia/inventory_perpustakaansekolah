

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
                <h3 class="card-title">Transaksi peralatan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
    <!-- Tambahkan wrapper untuk overflow -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-flat btn-outline-primary mb-3" data-toggle="modal" data-target="#exampleModal">
        Tambah Baru
            </button>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah peralatan</h5>
							</div>
							<div class="modal-body">
                                <?php
								include 'koneksi.php';
								
								$result = mysqli_query($koneksi, "SELECT kode_peralatan FROM peralatan ORDER BY id_peralatan DESC LIMIT 1");
								$row = mysqli_fetch_assoc($result);
                                
								if ($row) {
                                    $lastCode = $row['kode_peralatan'];
									$number = (int) substr($lastCode, -3);
									$newNumber = $number + 1;
                                    
									$newCode = 'PRLT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
								} else {
                                    $newCode = 'PRLT001';
								}
								?>
								<form class="form-horizontal" method="post" action="tambah_peralatan.php">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Kode</label>
											<div class="col-sm-10">
                                                <input type="text" class="form-control" name="kode_peralatan" id="kode_peralatan" value="<?php echo $newCode; ?>" readonly>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Peralatan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_peralatan" id="nama_peralatan" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jenis</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_jenis" id="id_jenis" required>
                                                    <option value="" disabled selected>Pilih Jenis</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_jenis = mysqli_query($koneksi, "SELECT id_jenis, nama_jenis FROM jenis");
                                                    while ($jenis = mysqli_fetch_array($query_jenis)) {
                                                        echo '<option value="' . $jenis['id_jenis'] . '">' . $jenis['nama_jenis'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Merk</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_merk" id="id_merk" required>
                                                    <option value="" disabled selected>Pilih Merk</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_merk = mysqli_query($koneksi, "SELECT id_merk, nama_merk FROM merk");
                                                    while ($merk = mysqli_fetch_array($query_merk)) {
                                                        echo '<option value="' . $merk['id_merk'] . '">' . $merk['nama_merk'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Warna</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="id_warna" id="id_warna" required>
                                                    <option value="" disabled selected>Pilih Warna</option>
                                                    <?php
                                                    include 'koneksi.php';
                                                    $query_warna = mysqli_query($koneksi, "SELECT id_warna, nama_warna FROM warna");
                                                    while ($warna = mysqli_fetch_array($query_warna)) {
                                                        echo '<option value="' . $warna['id_warna'] . '">' . $warna['nama_warna'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Beli</label>
											<div class="col-sm-10">
												<input type="date" class="form-control" name="tanggalbeli_peralatan" id="tanggalbeli_peralatan" required>
											</div>
										</div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status Peralatan</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="status_peralatan" id="status_peralatan" required>
                                                    <option value="" disabled selected>Pilih Status</option>
                                                    <option value="baik" >Baik</option>
                                                    <option value="rusak" >Rusak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Jumlah Kerusakan</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="jumlahkerusakan_peralatan" id="jumlahkerusakan_peralatan" value="0" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-nowrap">Ketersediaan</label>
                                            <div class="col-sm-10 mt-2 d-flex">
                                                <input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="statusketersediaan_peralatan" id="tersedia" value="Tersedia" checked>
                                                    <label class="form-check-label" for="tersedia">Tersedia</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="statusketersediaan_peralatan" id="tidak_tersedia" value="Tidak Tersedia">
                                                    <label class="form-check-label" for="tidak_tersedia">Tidak Tersedia</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Aturan Service</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="aturanservice_peralatan" id="aturanservice_peralatan" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
										<label class="col-sm-2 col-form-label">Image Peralatan</label>
										<div class="col-sm-10">
											<input type="file" class="form-control-file" name="gambar_peralatan" id="gambar_peralatan" accept="image/*" >
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
                <div style="overflow-x: auto;">
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Peralatan</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Warna</th>
                    <th>Tanggal Beli</th>
                    <th>Status Peralatan</th>
                    <th>Jumlah Kerusakan</th>
                    <th>Status Ketersediaan</th>
                    <th>Aturan Service</th>
                    <th>Image</th>
                </tr>
				  <?php
					include 'koneksi.php';

					$no = 1;
					$query = "select pr.id_peralatan, pr.kode_peralatan, pr.nama_peralatan, pr.tanggalbeli_peralatan, pr.status_peralatan, pr.jumlahkerusakan_peralatan, pr.statusketersediaan_peralatan, pr.aturanservice_peralatan, pr.image_peralatan, jn.id_jenis, jn.nama_jenis, mr.id_merk, mr.nama_merk, wr.id_warna, wr.nama_warna from peralatan pr join jenis jn on pr.id_jenis=jn.id_jenis join merk mr on pr.id_merk=mr.id_merk join warna wr on pr.id_warna=wr.id_warna";
					$data = mysqli_query($koneksi, $query) or die (mysqli_error($koneksi));
					while ($d = mysqli_fetch_array($data))
						{ 
				  ?>
                  </thead>
                  <tbody>
                  <tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $d['kode_peralatan']; ?></td>
					<td><?php echo $d['nama_peralatan']; ?></td> 
					<td><?php echo $d['nama_jenis']; ?></td> 
					<td><?php echo $d['nama_merk']; ?></td> 
					<td><?php echo $d['nama_warna']; ?></td> 
                    <td><?php echo $d['tanggalbeli_peralatan']; ?></td> 
                    <td><?php echo $d['status_peralatan']; ?></td> 
                    <td><?php echo $d['jumlahkerusakan_peralatan']; ?></td> 
                    <td><?php echo $d['statusketersediaan_peralatan']; ?></td> 
                    <td><?php echo $d['aturanservice_peralatan']; ?></td> 
                    <td>
						<?php if (!empty($d['image_peralatan']) && file_exists($d['image_peralatan'])): ?>
							<img src="<?php echo $d['image_peralatan']; ?>" alt="Image" class="img-fluid" style="max-width: 100px; height: 80px;">
						<?php else: ?>
							<img src="uploads/default.jpg" alt="No Image" class="img-fluid" style="max-width: 100px; height: 50px;">
						<?php endif; ?>
					</td>
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
								<h5 class="modal-title" id="modalHapus">Hapus Peralatan</h5>
							</div>
							<div class="d-flex modal-body bg-warning">
								<b class="mr-auto ml-2 p-2">Apakah anda yakin?</b>
								<a href="">
								<button type="button" class="btn btn-secondary p-2 mr-3" data-dismiss="modal">No</button>
								</a>
								<a href="hapus_peralatan.php?id_peralatan=<?php echo $d['id_peralatan']; ?>">
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
									<h5 class="modal-title" id="modalEdit">Edit Peralatan</h5>
								</div>
								<div class="modal-body">
								<form class="form-horizontal" method="post" action="update_peralatan.php">
								<div class="card-body">
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Kode</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
											<input type="text" class="form-control" name="kode_peralatan" value="<?php echo $d['kode_peralatan']; ?>" readonly>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-2 col-form-label ">Peralatan</label>
										<div class="col-sm-10">
											<input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
											<input type="text" class="form-control" name="nama_peralatan" value="<?php echo $d['nama_peralatan']; ?>" >
										</div>
									</div>
                                    <div class="form-group row">
										<label class="col-sm-2 col-form-label">Jenis</label>
										<div class="col-sm-10">
											<select class="form-control" name="id_jenis" required>
												<option value="">Pilih Jenis</option>
												<?php
												$query_jenis = mysqli_query($koneksi, "SELECT id_jenis, nama_jenis FROM jenis");
												while ($jenis = mysqli_fetch_array($query_jenis)) {
													$selected = ($jenis['id_jenis'] == $d['id_jenis']) ? 'selected' : '';
													echo '<option value="' . $jenis['id_jenis'] . '" ' . $selected . '>' . $jenis['nama_jenis'] . '</option>';
												}
												?>
											</select>
										</div>
									</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Merk</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_merk" required>
                                                <option value="">Pilih merk</option>
                                                <?php
                                                $query_merk = mysqli_query($koneksi, "SELECT id_merk, nama_merk FROM merk");
                                                while ($merk = mysqli_fetch_array($query_merk)) {
                                                    $selected = ($merk['id_merk'] == $d['id_merk']) ? 'selected' : '';
                                                    echo '<option value="' . $merk['id_merk'] . '" ' . $selected . '>' . $merk['nama_merk'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Warna</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="id_warna" required>
                                                <option value="">Pilih Warna</option>
                                                <?php
                                                $query_warna = mysqli_query($koneksi, "SELECT id_warna, nama_warna FROM warna");
                                                while ($warna = mysqli_fetch_array($query_warna)) {
                                                    $selected = ($warna['id_warna'] == $d['id_warna']) ? 'selected' : '';
                                                    echo '<option value="' . $warna['id_warna'] . '" ' . $selected . '>' . $warna['nama_warna'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Beli</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
                                            <input type="date" class="form-control" name="tanggalbeli_peralatan" value="<?php echo $d['tanggalbeli_peralatan']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Peralatan</label>
													<div class="col-sm-10">
														<select class="form-control" name="status_peralatan" required>
															<option value=""> Pilih Status </option>
															<option value="Baik" <?= ($d['status_peralatan'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
															<option value="Rusak" <?= ($d['status_peralatan'] === 'Rusak') ? 'selected' : ''; ?>>Rusak</option>														</select>
													</div>
												</div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Jumlah Kerusakan</label>
                                        <div class="col-sm-10">
                                            <input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
                                            <input type="number" class="form-control" name="jumlahkerusakan_peralatan" value="<?php echo $d['jumlahkerusakan_peralatan']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-nowrap">Ketersediaan</label>
                                        <div class="col-sm-10 mt-2 d-flex">
                                            <div class="form-check mr-3">
                                                <input class="form-check-input" type="radio" name="statusketersediaan_peralatan" value="Tersedia" <?= ($d['statusketersediaan_peralatan'] === 'Tersedia') ? 'checked' : ''; ?>>
															<label class="form-check-label">Tersedia</label>
														</div>
														<div class="form-check">
                                                            <input class="form-check-input" type="radio" name="statusketersediaan_peralatan" value="Tidak Tersedia" <?= ($d['statusketersediaan_peralatan'] === 'Tidak Tersedia') ? 'checked' : ''; ?>>
															<label class="form-check-label">Tidak Tersedia</label>
														</div>
													</div>
												</div>
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">Aturan Service</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="id_peralatan" value="<?php echo $d['id_peralatan']; ?>">
                                                        <input type="number" class="form-control" name="aturanservice_peralatan" value="<?php echo $d['aturanservice_peralatan']; ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
													<label class="col-sm-2 col-form-label text-nowrap">Image</label>
													<div class="col-sm-10">
														<input type="file" class="form-control-file" name="gambar_peralatan" accept="image/*">
													</div>
												</div>
                                            </div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="update_peralatan.php?id_peralatan=<?php echo $d['id_peralatan']; ?>">
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
    document.addEventListener('DOMContentLoaded', function () {
        const statusPeralatan = document.getElementById('status_peralatan');
        const jumlahKerusakan = document.getElementById('jumlahkerusakan_peralatan');

        // Fungsi untuk mengatur disabled/enabled
        function toggleJumlahKerusakan() {
            if (statusPeralatan.value === 'baik') {
                jumlahKerusakan.disabled = true;
                jumlahKerusakan.value = '0'; // Kosongkan nilai jika disabled
            } else if (statusPeralatan.value === 'rusak') {
                jumlahKerusakan.disabled = false;
                jumlahKerusakan.value = '1'; 
            }
        }

        // Jalankan fungsi saat halaman dimuat
        toggleJumlahKerusakan();

        // Tambahkan event listener untuk perubahan status
        statusPeralatan.addEventListener('change', toggleJumlahKerusakan);
    });
</script>



	