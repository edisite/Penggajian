<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Absensi</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
				<div class="breadcrumb-item">Data Absensi</div>
			</div>
		</div>
		<div class="section-body">
			<a href="<?= base_url('admin/absensi/create') ?>" class="btn btn-primary btn-s"><i class="fa fa-plus"></i> Add Data</a><br><br>
			<div class="row">
				<div class="col-12">
					<div class="card">
                                                <div class="card-header">
                                                        <div class="row">
                                                                <div class="form-group" style="margin: 10px">
                                                                <form action="<?php echo base_url().'admin/absensi'; ?>" method="get">                                        
                                                                            <input type="month" class="form-control" id="date" name="datetrans" value="<?php echo $datetrans; ?>">                                                 
                                                                <form>                                
                                                                </div> 
                                                                <div class="form-group" style="margin: 10px">                               
                                                                            <button type="submit" id="saveBtn" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                                                                </div>   

                                                        </div>                            
                                                </div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped" id="example">
									<thead>
										<tr>
											<th class="text-center">
												#
											</th>
											<th>ID</th>
											<th>Periode</th>
											<th>Nama Karyawan</th>
											<th>Jabatan</th>
											<th>Bagian</th>
											<!--<th>Jam Hadir</th>-->
											<th>Sakit</th>
											<th>Izin</th>
											<th>Tidak Hadir</th>
											<th>Terlambat</th>
											<th>Total Kehadiran</th>
											<th>Potongan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($absensi as $data) : ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= $data->id_karyawan ?></td>
												<td><?= $data->periode_tanggal ?></td>
												<td><?= $data->nama_karyawan ?></td>
												<td><?= $data->nama_jabatan ?></td>
												<td><?= $data->nama_bagian ?></td>
												
												<td><?= $data->sakit ?></td>
												<td><?= $data->izin ?></td>
												<td><?= $data->tidak_hadir ?></td>
												<td><?= $data->terlambat ?></td>
					
												<td><?= $data->total ?> hari</td>
												<td>Rp. <?= rupiah($data->potongan) ?></td>
												<td>
												<?php
													if (date('Y-m') == $data->periode_tanggal){
													?>
													
														<a href="<?php echo base_url('admin/absensi/edit/') . $data->id_absen ?>" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i> </a>
														<a href="<?php echo base_url('admin/absensi/delete/') . $data->id_absen ?>" class="btn btn-danger" onclick="javascript: return confirm('Are you sure want to Delete ?')" title="Delete"><i class="fa fa-trash"></i></a>

													<?php 
													}
												?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>
