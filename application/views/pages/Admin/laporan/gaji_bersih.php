<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Gaji Bersih</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Gaji Bersih</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                                <div class="row">
                                    <div class="form-group" style="margin: 10px">
                                        <form action="<?php echo base_url().'admin/gaji_bersih'; ?>" method="get">                                        
                                                    <input type="month" class="form-control" id="month" name="datetrans" value="<?php echo $datetrans; ?>">                                                 
                                        <form>                                
                                    </div> 
                                    <div class="form-group" style="margin: 10px">                               
                                                <button type="submit" id="saveBtn" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                                    </div>  
                                    <div class="form-group pull-right" style="margin: 10px" >
                                        <a href="<?php echo site_url('admin/print/gaji_bersih/'.$datetrans) ?>" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"> Print Laporan </i></a>
                                    </div> 
                                    
                                </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>ID</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Bagian</th>
                                            <th>Gaji Kotor</th>
                                            <th>Potongan Absen</th>
                                            <th>Pinjaman</th>
                                            <th>BPJS Ketenagakerjaan</th>
                                            <th>BPJS Kesehatan</th>
                                            <th>Total Gaji Bersih</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($penggajian as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->id_karyawan ?></td>
                                                <td><?= $data->nama_karyawan ?></td>
                                                <td><?= $data->nama_jabatan ?></td>
                                                <td><?= $data->nama_bagian ?></td>
                                                <td>Rp. <?= rupiah($data->gaji_kotor) ?></td>
                                                <td>Rp. <?= rupiah($data->potongan_absen) ?></td>
                                                <td>Rp. <?= rupiah($data->pinjaman) ?></td>
                                                <td>Rp. <?= rupiah($data->bpjs1) ?></td>
                                                <td>Rp. <?= rupiah($data->bpjs2) ?></td>
                                                <td>Rp. <?= rupiah($data->gaji_bersih) ?></td>
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
