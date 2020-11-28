<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KaryawanController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('logged_in' !== TRUE)) {
			redirect('/auth');
		}
	}

	public function index()
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Karyawan"
			);
			$data['karyawan']	 	= $this->db->query("SELECT * FROM jabatan INNER JOIN karyawan ON jabatan.id_jabatan = karyawan.id_jabatan INNER JOIn bagian ON karyawan.id_bagian = bagian.id_bagian")->result();
			$this->load->view('pages/Admin/karyawan/index.php', $data);
		} else {
			redirect('/');
		}
	}

	public function create()
	{
		$this->load->helper('string');
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Karyawan"

			);
			$data['jabatan']		= $this->db->query("SELECT * FROM jabatan")->result();
			$data['bagian']			= $this->db->query("SELECT * FROM bagian")->result();
			//add by edi
			$data['generate_id_karyawan']			= random_string('nozero', 8);
			//--- end ----
			$this->load->view('pages/Admin/karyawan/add', $data);
		} else {
			redirect('/');
		}
	}

	public function store()
	{
		$id         	        = $this->input->post('id');
		$nama                   = $this->input->post('nama');
		$jabatan                = $this->input->post('jabatan');
		$bagian                 = '';
		$alamat          	= $this->input->post('alamat');
		$lahir            	= $this->input->post('lahir');
		$status                 = $this->input->post('status');
		$jumlah                 = $this->input->post('jumlah');
		$telp                   = $this->input->post('telp');
		$status_kerja           = $this->input->post('status_kerja');
		$masuk                  = $this->input->post('masuk');
		$email                  = $this->input->post('email');
		$no_rekening            = $this->input->post('no_rekening');
		$bank                   = $this->input->post('bank');

		if ($status_kerja == NULL) {
			$status_kerja = 0;
		} else {
			$status_kerja = 1;
		}
//                echo $jabatan;
                $qryjabatan			= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '".$jabatan."'");
		
		if ($qryjabatan->num_rows() > 0) {
			$datajabatan			= $qryjabatan->row_array();
			$bagian	= $datajabatan['id_bagian'] ?: '';
                } 
		$data = array(
			'id_karyawan'				=> $id,
			'nama_karyawan'				=> $nama,
			'id_jabatan'				=> $jabatan,
			'id_bagian'					=> $bagian,
			'alamat'					=> $alamat,
			'tanggal_lahir'				=> $lahir,
			'status'					=> $status,
			'jumlah_keluarga'			=> $jumlah,
			'telp'						=> $telp,
			'status_kerja'				=> $status_kerja,
			'tanggal_masuk'				=> $masuk,
			'email'						=> $email,
			'bank'						=> $bank,
			'no_rekening'						=> $no_rekening,
		);	
		$this->db->insert('karyawan', $data);
		// --------------------------------------------------
		//edit by edi	
		$data_bpjs_ketenagakerjaan = array(
			'id_karyawan'				=> $id,
		);		
		$data_bpjs_kesehatan = array(
			'id_karyawan'				=> $id,
		);
		$data_bpjs_absensi = array(
			'id_karyawan'				=> $id,
		);
                
                
                // auto create karyawan
//		$this->bpjs_ketenagankerjaan($id, $jabatan);
//		$this->bpjs_kesehatan($id, $jabatan);
//		$this->absensi($id, $masuk);
//		$this->pengajian($id, $masuk);

		//--- end -------------------------------------------

		redirect('admin/karyawan');
	}

	protected function bpjs_ketenagankerjaan($in_karyawan= '', $id_jabatan = ''){
		$karyawan           = $in_karyawan;
		//$jkk 	                    = 1;
		// $result						= $this->db->query("SELECT * FROM karyawan WHERE id = '$karyawan'");
		$result_jkk			= $this->db->query("SELECT nama_jkk FROM `setting_jenis_jkk`  
		ORDER BY `setting_jenis_jkk`.`id_jkk`  ASC limit 1");
		$jkk = $result_jkk->row_array()['nama_jkk'] ?: '';

		$result				= $this->db->query("SELECT * FROM karyawan WHERE id_karyawan = '$karyawan'");

		if ($result->num_rows() > 0) {
			$data				= $result->row_array();
			$id_karyawan_kode	= $data['id'];
		}
		else{
			return false;
		}

		$result1			= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'");
		
		if ($result1->num_rows() > 0) {
			$data			= $result1->row_array();
			$gaji_kotor		= $data['gaji_kotor'];
		}
		
		$result2			= $this->db->query("SELECT * FROM setting_ketenagakerjaan");
		
		if ($result2->num_rows() > 0) {
			$data			= $result2->row_array();
			$jht_perusahaan	= $data['jht_perusahaan'];
			$jht_karyawan	= $data['jht_karyawan'];
			$jkm			= $data['jkm'];
			$jp_perusahaan	= $data['jp_perusahaan'];
			$jp_karyawan	= $data['jp_karyawan'];
			
			$x				= $gaji_kotor * ($jht_perusahaan / 100);
			$y				= $gaji_kotor * ($jht_karyawan / 100);
			$a				= $gaji_kotor * ($jkm / 100);
			$b				= $gaji_kotor * ($jp_perusahaan / 100);
			$c				= $gaji_kotor * ($jp_karyawan / 100);
		}else{
			return false;
		}
		
		$result3			= $this->db->query("SELECT * FROM setting_jenis_jkk WHERE nama_jkk = '$jkk'");
		// default rate & z
		$rate 	= 0;
		$z 		= 0;
		if ($result3->num_rows() > 0) {
			$data			= $result3->row_array();
			$rate			= $data['rate'];
			
			$z				= $gaji_kotor * ($rate / 100);
		}
		$total = $x + $y + $z + $a + $b + $b + $c;

		$data = array(
			'id_karyawan'				=> $id_karyawan_kode,
			'perhitungan_dasar'			=> $gaji_kotor,
			'jht_perusahaan'			=> $x,
			'jht_karyawan'				=> $y,
			'jenis_jkk'					=> $jkk,
			'jkk'						=> $z,
			'jkm'						=> $a,
			'jp_perusahaan'				=> $b,
			'jp_karyawan'				=> $c,
			'total'						=> $total
		);

		$this->db->insert('bpjs_ketenagakerjaan', $data);
		return true;
	}

	protected function bpjs_kesehatan($in_karyawan= '', $id_jabatan = '')
	{
		$karyawan                   = $in_karyawan;
		$result						= $this->db->query("SELECT * FROM karyawan WHERE id_karyawan = '$karyawan'");
		
		if ($result->num_rows() > 0) {
			$data			= $result->row_array();
			$id_jabatan		= $data['id_jabatan'] ?: $id_jabatan;
			$jumlah			= $data['jumlah_keluarga'];
			$id_jabatan_kode	= $data['id'];

			$result1		= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'");

			if ($result1->num_rows() > 0) {
				$data			= $result1->row_array();
				$gaji_kotor		= $data['gaji_kotor'];
			}
		}else{
			return false;
		}

		$result2		= $this->db->query("SELECT * FROM setting_kesehatan");
 
		if ($result2->num_rows() > 0) {
			$data				= $result2->row_array();
			$bpjs_perusahaan	= $data['bpjs_perusahaan'];
			$bpjs_karyawan	= $data['bpjs_karyawan'];

			$x				= $gaji_kotor * ($bpjs_perusahaan / 100);
			$y				= $gaji_kotor * (($bpjs_karyawan * $jumlah) / 100);
		}else{
			return false;
		}

		$total = $x + $y;

		$data = array(
			'id_karyawan'				=> $id_jabatan_kode,
			'perhitungan_dasar'			=> $gaji_kotor,
			'bpjs_perusahaan'			=> $x,
			'bpjs_karyawan'				=> $y,
			'total'						=> $total
		);

		$this->db->insert('bpjs_kesehatan', $data);
		return true;
	}

	protected function absensi($in_karyawan= '', $masuk = '')
	{
		$karyawan                   = $in_karyawan;
		$result						= $this->db->query("SELECT * FROM karyawan WHERE id_karyawan = '$karyawan'");
		
		if ($result->num_rows() > 0) {
			$data				= $result->row_array();
			$id_karyawan_kode	= $data['id'];
		}else{
			return false;
		}

		$date = new DateTime($masuk);
		$tgltrans	=	 $date->format('Y-m');

		$data = array(
			'id_karyawan'					=> $id_karyawan_kode,
			'periode_tanggal'				=> $tgltrans,
			'jam_hadir'						=> 0,
			'sakit'							=> 0,
			'izin'							=> 0,
			'tidak_hadir'					=> 0,
			'terlambat'						=> 0,
			'total'							=> 0,
			'potongan'						=> 0
		);

		$this->db->insert('absensi', $data);
		return true;
	}	
	protected function pengajian($in_karyawan= '', $masuk = '')
	{
		$karyawan                   = $in_karyawan;
		$result						= $this->db->query("SELECT * FROM karyawan WHERE id_karyawan = '$karyawan'");
		
		$date = new DateTime($masuk);
		$tgltrans	=	 $date->format('Y-m');

		if ($result->num_rows() > 0) {
			$data			= $result->row_array();
			$id_jabatan		= $data['id_jabatan'];
			$karyawan	= $data['id'];

			$result1						= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = $id_jabatan");

			if ($result1->num_rows() > 0) {
				$data			= $result1->row_array();
				$gaji_kotor		= $data['gaji_kotor'];
			}

			$result2						= $this->db->query("SELECT * FROM absensi WHERE id_karyawan = $karyawan");

			if ($result2->num_rows() > 0) {
				$data				= $result2->row_array();
				$potongan_absen		= $data['potongan'];
			}

			$result3						= $this->db->query("SELECT * FROM peminjaman WHERE id_karyawan = $karyawan AND status = '1'");

			if ($result3->num_rows() > 0) {
				$data				= $result3->row_array();
				$besar_pinjaman		= $data['besar_pinjaman'];
			} else {
				$besar_pinjaman = '0';
			}

			$result4						= $this->db->query("SELECT * FROM bpjs_ketenagakerjaan WHERE id_karyawan = $karyawan");

			if ($result4->num_rows() > 0) {
				$data				= $result4->row_array();
				$bpjs1				= $data['total'];
			}

			$result5						= $this->db->query("SELECT * FROM bpjs_kesehatan WHERE id_karyawan = $karyawan");

			if ($result5->num_rows() > 0) {
				$data				= $result5->row_array();
				$bpjs2				= $data['total'];
			}

			$gaji_bersih = $gaji_kotor - $potongan_absen - $besar_pinjaman - $bpjs1 - $bpjs2;
		}
		$data = array(
			'id_karyawan'					=> $karyawan,
			'periode_bulan'					=> $tgltrans,
			'gaji_kotor'					=> $gaji_kotor,
			'potongan_absen'				=> $potongan_absen,
			'pinjaman'						=> $besar_pinjaman,
			'bpjs1'							=> $bpjs1,
			'bpjs2'							=> $bpjs2,
			'gaji_bersih'					=> $gaji_bersih
		);

		$this->db->insert('penggajian', $data);
	}

	public function edit($id)
	{
		if ($this->session->userdata('role') === '1') {
			$data = array(
				'title' => "Data Karyawan"
			);
			$where = array('id' => $id);
			$data['karyawan'] 		= $this->db->query("SELECT * FROM karyawan WHERE id='$id'")->result();
			$data['jabatan']        = $this->db->query("SELECT * FROM jabatan")->result();
			$data['bagian']         = $this->db->query("SELECT * FROM bagian")->result();
			$this->load->view('pages/Admin/karyawan/edit', $data);
		} else {
			redirect('/');
		}
	}

	public function update()
	{
		$id         	        = $this->input->post('id');
		$id_k         	        = $this->input->post('id_k');
		$nama                   = $this->input->post('nama');
		$jabatan                = $this->input->post('jabatan');
		$bagian                 = '';
		$alamat          	    = $this->input->post('alamat');
		$lahir            	    = $this->input->post('lahir');
		$status                 = $this->input->post('status');
		$jumlah                 = $this->input->post('jumlah');
		$telp                   = $this->input->post('telp');
		$status_kerja           = $this->input->post('status_kerja');
		$masuk                  = $this->input->post('masuk');
		$email                  = $this->input->post('email');
		$no_rekening            = $this->input->post('no_rekening');
		$bank                   = $this->input->post('bank');
		if ($status_kerja == NULL) {
			$status_kerja = 0;
		} else {
			$status_kerja = 1;
		}
                $qryjabatan			= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '".$jabatan."'");
		
		if ($qryjabatan->num_rows() > 0) {
			$datajabatan			= $qryjabatan->row_array();
			$bagian	= $datajabatan['id_bagian'] ?: '';
                } 

		$data = array(
			'id_karyawan'				=> $id_k,
			'nama_karyawan'				=> $nama,
			'id_jabatan'				=> $jabatan,
			'id_bagian'					=> $bagian,
			'alamat'					=> $alamat,
			'tanggal_lahir'				=> $lahir,
			'status'					=> $status,
			'jumlah_keluarga'			=> $jumlah,
			'telp'						=> $telp,
			'status_kerja'				=> $status_kerja,
			'tanggal_masuk'				=> $masuk,
			'email'						=> $email,
                        'bank'						=> $bank,
			'no_rekening'						=> $no_rekening,
		);

		$where = array('id' => $id);
		$this->db->update('karyawan', $data, $where);
                
                $this->load->model('M_Dashboard');
                $this->M_Dashboard->update_bpjs_kesehatan_redirect($id);
		redirect('admin/karyawan');
	}

	public function delete($id)
	{
		$where = array('id' => $id);
		$where_triger = array('id_karyawan' => $id);
		$this->db->delete('absensi', $where_triger);
		$this->db->delete('penggajian', $where_triger);
		$this->db->delete('karyawan', $where);
		redirect('admin/karyawan');
	}
        public function loadData_select_jabatan(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$sql    = "SELECT id_jabatan, nama_jabatan from jabatan where nama_jabatan like '$param%'";
		$query  = $this->db->query($sql);
                $response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->id_jabatan,
					'text'	=> $val->nama_jabatan
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

}
