<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
	<style type="text/css">
		.table-data {
			width: 100%;
			border-collapse: collapse;
		}

		.table-data tr th,
		.table-data tr td {
			border: 1px solid black;
			font-size: 11pt;
			font-family: Verdana;
			padding: 10px 10px 10px 10px;
		}

		h3 {
			font-family: Verdana;
		}
	</style>
	<h3>
		Laporan Data Penyewaan Rumah
	</h3>
	<br>
	<table class="table-data">
		<thead>
			<tr>
				<th>No Pesan</th>
				<th>Tanggal Pesan</th>
				<th>Penyewa</th>
				<th>Rumah</th>
				<th>Tanggal Mulai</th>
				<th>Tanggal Keluar</th>
				<th>Tanggal Pengembalian</th>
				<th>Terlambat</th>
				<th>Status</th>
			</tr>
		</thead>
		<?php
		$user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
		$idku =  $user['id'];
		foreach ($laporan as $p)
			if ($user['role_id'] == 1) {
		?>
			<tbody>
				<tr>
					<td><?= $p['no_pesan']; ?></td>
					<td><?= $p['tgl_pesan']; ?></td>
					<td><?= $p['nama']; ?></td>
					<td scope="col">
						<picture>
							<img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" width="100" height="70" alt="...">
						</picture>
					</td>
					<td><?= $p['w_mulai']; ?></td>
					<td><?= $p['tgl_kembali']; ?></td>
					<td><?= $p['tgl_pengembalian']; ?></td>
					<!-- <td>
                                                            <?= date('Y-m-d'); ?>
                                                            <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                                        </td> -->
					<td>
						<?php
						$tgl1 = new DateTime($p['tgl_kembali']);
						$tgl2 = new DateTime($p['w_mulai']);
						$selisih = $tgl2->diff($tgl1)->format("%a");
						echo $selisih;
						?> Hari
					</td>
					<?php if ($p['status'] == "Ditempati") {
						$status = "btn warning";
					} else {
						$status = "btn danger";
					} ?>
					<td><i class="btn btn-outline-primary<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td>


				</tr>
			</tbody>
			<?php } else {
				if ($p['id_pemilik'] == $idku) {  ?>
				<tbody>
					<tr>
						<td><?= $p['no_pesan']; ?></td>
						<td><?= $p['tgl_pesan']; ?></td>
						<td><?= $p['nama']; ?></td>
						<td scope="col">
							<picture>
								<img src="<?= base_url('assets/img/upload/') . $p['image']; ?>" width="100" height="70" alt="...">
							</picture>
						</td>
						<td><?= $p['w_mulai']; ?></td>
						<td><?= $p['tgl_kembali']; ?></td>
						<td><?= $p['tgl_pengembalian']; ?></td>
						<!-- <td>
                                                            <?= date('Y-m-d'); ?>
                                                            <input type="hidden" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= date('Y-m-d'); ?>">
                                                        </td> -->
						<td>
							<?php
							$tgl1 = new DateTime($p['tgl_kembali']);
							$tgl2 = new DateTime($p['w_mulai']);
							$selisih = $tgl2->diff($tgl1)->format("%a");
							echo $selisih;
							?> Hari
						</td>
						<?php if ($p['status'] == "Ditempati") {
							$status = "btn warning";
						} else {
							$status = "btn danger";
						} ?>
						<td><i class="btn btn-outline-primary<?= $status; ?> btn-sm"><?= $p['status']; ?></i></td>


					</tr>
				</tbody>
		<?php
				}
			}
		?>
	</table>
	<script type="text/javascript">
		window.print();
	</script>
</body>

</html>