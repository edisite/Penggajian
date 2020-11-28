<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan Absensi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Laporan Absensi</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                            <div class="row">
                                    <div class="form-group" style="margin: 10px">
                                    <form action="<?php echo base_url().'admin/report/absensi'; ?>" method="get">                                        
                                                <input type="month" class="form-control" id="date" name="datetrans" value="<?php echo $datetrans; ?>">                                                 
                                    <form>                                
                                    </div> 
                                    <div class="form-group" style="margin: 10px">                               
                                                <button type="submit" id="saveBtn" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                                    </div>   
                                    
                            </div>
                                <div class="form-group pull-right" style="margin: 10px" >
                                        <a href="<?php echo site_url('admin/print/absensi/'.$datetrans) ?>" target="_blank" class="btn btn-danger pull-right"><i class="fa fa-print"> Print Laporan </i></a>
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
                                            <th>Nama Karyawan</th>
                                            <th>Jabatan</th>
                                            <th>Bagian</th>
                                            <th>Jam Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Tidak Hadir</th>
                                            <th>Terlambat</th>
                                            <th>Total Kehadiran</th>
                                            <th>Potongan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($absensi as $data) : ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data->id_karyawan ?></td>
                                                <td><?= $data->nama_karyawan ?></td>
                                                <td><?= $data->nama_jabatan ?></td>
                                                <td><?= $data->nama_bagian ?></td>
                                                <td><?= $data->jam_hadir ?></td>
                                                <td><?= $data->sakit ?></td>
                                                <td><?= $data->izin ?></td>
                                                <td><?= $data->tidak_hadir ?></td>
                                                <td><?= $data->terlambat ?></td>
                                                <td><?= $data->total ?> hari</td>
                                                <td>Rp. <?= rupiah($data->potongan) ?></td>
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
<!-- <script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' sd ' + picker.endDate.format('YYYY-MM-DD'));
  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script> -->
