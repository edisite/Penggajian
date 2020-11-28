<?php
defined('BASEPATH') or exit('No direct script access allowed');
$data['admin'] = $this->db->get_where('auth', ['id_auth' => $this->session->userdata('id')])->row_array();
$this->load->view('dist/_partials/header', $data);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Add Data</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Data</h4>
                        </div>
                        <div class="card-body">
                            <form method="post" class="needs-validation" action="<?php echo site_url('admin/karyawan/store') ?>" novalidate="">
                                <div class="form-group">
                                    <label for="id">ID Karyawan</label>
                                    <input id="id" type="number" class="form-control" name="id" tabindex="1" value="<?php echo $generate_id_karyawan; ?>" required autofocus>
                                    <div class="invalid-feedback">
                                        Masukkan ID jabatan terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Karyawan</label>
                                    <input id="nama" type="text" class="form-control" name="nama" value="" tabindex="1" required>
                                    <div class="invalid-feedback">
                                        Masukkan nama karyawan terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pilih Jabatan</label>
                                    <select class="form-control selectric" id="jabatan" name="jabatan">
                                         <option value="" selected disabled>-- Pilih Jabatan --</option> 
                                        <?php
                                        foreach ($jabatan as $data) : ?>
                                            <option value="<?= $data->id_jabatan ?>"><?= $data->nama_jabatan ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" required=""></textarea>
                                    <div class="invalid-feedback">
                                        Masukkan alamat karyawan terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker" name="lahir">
                                </div>
                                <div class="form-group">
                                    <label>Status Pernikahan</label>
                                    <select class="form-control selectric" id="status" name="status">
                                        <option value="" selected disabled>-- Pilih Status Pernikahan --</option>
                                        <option value="0" selected>Single</option>
                                        <option value="1">Menikah</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Keluarga Tanggungan</label>
                                    <input id="jumlah" type="number" class="form-control" name="jumlah" tabindex="1" required value='1'>
                                    <div class="invalid-feedback">
                                        Masukkan Jumlah keluarga tanggungan terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="telp">No. Telp</label>
                                    <input id="telp" type="number" class="form-control" name="telp" tabindex="1" required value="">
                                    <div class="invalid-feedback">
                                        Masukkan nomor telepon terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">Status</div>
                                    <label class="custom-switch mt-2">
                                        <span class="custom-switch-description">Tidak Aktif &nbsp;</span>
                                        <input type="checkbox" name="status_kerja" value="1" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Aktif</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Masuk</label>
                                    <input type="text" class="form-control datepicker" name="masuk">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required value="">
                                    <div class="invalid-feedback">
                                        Masukkan email terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <input id="bank" type="text" class="form-control" name="bank" tabindex="1" required value="">
                                    <div class="invalid-feedback">
                                        Masukkan Bank terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_rekening">No Rekening</label>
                                    <input id="no_rekening" type="text" class="form-control" name="no_rekening" tabindex="1" required value="">
                                    <div class="invalid-feedback">
                                        Masukkan No Rekening terlebih dahulu
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Add Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('dist/_partials/footer'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        var $base_url = $("body").data("base_url");
        $('.select2').select2();
        $('.select2').width('100%');
        $('#m_barang_id').css('width', '100%');
        
        selectList_jabatan();
    });

    $('#jabatan').on('select2:select', function (evt) {
        $("#m_barang_id").select2();
        $("#m_barang_id").select2('destroy');
        $("#m_barang_id").empty();
        id_jenis = $(evt.currentTarget).find("option:selected").val();
        selectList_barang2("#m_barang_id", id_jenis);
    });
    function selectList_jabatan() {
        $('#jabatan').select2({
          placeholder: 'Pilih Jabatan',
          multiple: false,
          allowClear: true,
          ajax: {
            url: $base_url+'admin/karyawan/loadDataJabatan',
            dataType: 'json',
            delay: 100,
            cache: true,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
              // parse the results into the format expected by Select2
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data, except to indicate that infinite
              // scrolling can be used
              params.page = params.page || 1;

              return {
                results: data.items,
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
              };
            }
          },
          escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
          minimumInputLength: 1,
          templateResult: FormatResult,
          templateSelection: FormatSelection,
        });
    }


            
</script>