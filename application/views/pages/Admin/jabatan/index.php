<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Jabatan</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Jabatan</div>
			</div>
		</div>
		<div class="section-body">
			<a href="<?= base_url('admin/jabatan/create') ?>" class="btn btn-primary btn-s"><i class="fa fa-plus"></i> Add Data</a><br><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="example">
									<thead>
										<tr>
											<th class="text-center">
												#
											</th>
											<th>Jabatan</th>
											<th>Bagian</th>
											<th>Gaji Pokok</th>
											<th>Uang Makan</th>
											<th>IP1</th>
											<th>IP2</th>
											<th>THR</th>
											<!-- <th>IPK</th> -->
											<th>Lain-lain</th>
											<th>Gaji Kotor</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($jabatan as $data) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->nama_jabatan ?></td>
												<td><?= $data->nama_bagian ?></td>
												<td>Rp. <?= rupiah($data->gaji_pokok) ?></td>
												<td>Rp. <?= rupiah($data->uang_makan) ?></td>
												<td>Rp. <?= rupiah($data->insentif_penjualan) ?></td>
												<td>Rp. <?= rupiah($data->insentif_pengiriman) ?></td>
												<td>Rp. <?= rupiah($data->thr) ?></td>
												<td>Rp. <?= rupiah($data->lain_lain) ?></td>
												<td>Rp. <?= rupiah($data->gaji_kotor) ?></td>
												<td>
													<a href="<?php echo base_url('admin/jabatan/edit/') . $data->id_jabatan ?>" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
													<a href="<?php echo base_url('admin/jabatan/delete/') . $data->id_jabatan ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure want to Delete ?')" title="Delete"><i class="fa fa-trash"></i></a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
								Keterangan : <br>
								- IP1 : Insentif Penjualan <br>
								- IP2 : Insentif Pengiriman <br>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>
