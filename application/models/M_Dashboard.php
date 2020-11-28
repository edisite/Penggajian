<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Dashboard extends CI_Model
{

        public function service()
        {
                $sql = "SELECT count(id) as a FROM transaction WHERE status = 2";
                return $this->db->query($sql)->result();
        }

        public function ambulance()
        {
                $sql = "SELECT count(id_sewa) as c FROM sewa_ambulance WHERE status_peminjaman = 1";
                return $this->db->query($sql)->result();
        }
        public function update_pengajian($karyawan = '', $datetrans = ''){
                if(empty($datetrans)){
                    $datetrans  = date('Y-m');
                }
                $result		= $this->db->query("SELECT * FROM karyawan WHERE id = $karyawan");
                if ($result->num_rows() > 0) {
                        $data0			= $result->row_array();
                        $id_jabatan		= $data0['id_jabatan'];                            
                        
                        $gaji_kotor = 0;
                        $result1 = $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = $id_jabatan");

                        if ($result1->num_rows() > 0) {
                                $data1			= $result1->row_array();
                                $gaji_kotor		= $data1['gaji_kotor'];
                        }
                        $potongan_absen     = 0;
                        $result2 = $this->db->query("SELECT * FROM absensi WHERE id_karyawan = $karyawan AND periode_tanggal = '".$datetrans."'");

                        if ($result2->num_rows() > 0) {
                                $data2				= $result2->row_array();
                                $potongan_absen		= $data2['potongan'];
                        }
                        
                        $besar_pinjaman = 0;
                        $result3 = $this->db->query("SELECT * FROM peminjaman WHERE id_karyawan = $karyawan AND status = '1'");

                        if ($result3->num_rows() > 0) {
                                $data3				= $result3->row_array();
                                $besar_pinjaman		= $data3['besar_pinjaman'] ?: 0;
                        } else {
                                $besar_pinjaman = 0;
                        }
                        
                        $bpjs1 = 0;
                        $result4 = $this->db->query("SELECT * FROM bpjs_ketenagakerjaan WHERE id_karyawan = $karyawan");

                        if ($result4->num_rows() > 0) {
                                $data4				= $result4->row_array();
                                $bpjs1				= $data4['total'];
                        }
                        $bpjs2 = 0;
                        $result5 = $this->db->query("SELECT * FROM bpjs_kesehatan WHERE id_karyawan = $karyawan");

                        if ($result5->num_rows() > 0) {
                                $data5				= $result5->row_array();
                                $bpjs2				= $data5['total'];
                        }

                        $gaji_bersih = $gaji_kotor - $potongan_absen - $besar_pinjaman - $bpjs1 - $bpjs2;
                        $data = array(
                            // 'id_karyawan'					=> $karyawan,
                            'gaji_kotor'					=> $gaji_kotor,
                            'potongan_absen'				=> $potongan_absen,
                            'pinjaman'						=> $besar_pinjaman,
                            'bpjs1'							=> $bpjs1,
                            'bpjs2'							=> $bpjs2,
                            'gaji_bersih'					=> $gaji_bersih
                        );

                        $where = array('id_karyawan' => $karyawan,'periode_bulan' => $datetrans);
                        $this->db->update('penggajian', $data, $where);                
                        return;
                }      
        }
        
        public function update_bpjs_ketenagakerjaan($karyawan, $id_bpjs, $jkk) {
            
            $result			    = $this->db->query("SELECT * FROM karyawan WHERE id = '$karyawan'");

            if ($result->num_rows() > 0) {
                $data		= $result->row_array();
                $id_jabatan	= $data['id_jabatan'];
                $result1	= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'");

                if ($result1->num_rows() > 0) {
                    $data	= $result1->row_array();
                    $gaji_kotor = $data['gaji_kotor'];
                }
            }else{
                return;
            }
            
            $result2		= $this->db->query("SELECT * FROM setting_ketenagakerjaan");

            if ($result2->num_rows() > 0) {
                    $data		= $result2->row_array();
                    $jht_perusahaan	= $data['jht_perusahaan'];
                    $jht_karyawan	= $data['jht_karyawan'];
                    $jkm		= $data['jkm'];
                    $jp_perusahaan	= $data['jp_perusahaan'];
                    $jp_karyawan	= $data['jp_karyawan'];

                    $x				= $gaji_kotor * ($jht_perusahaan / 100);
                    $y				= $gaji_kotor * ($jht_karyawan / 100);
                    $a				= $gaji_kotor * ($jkm / 100);
                    $b				= $gaji_kotor * ($jp_perusahaan / 100);
                    $c				= $gaji_kotor * ($jp_karyawan / 100);
            }

            $result3	= $this->db->query("SELECT * FROM setting_jenis_jkk WHERE nama_jkk = '$jkk'");

            if ($result3->num_rows() > 0) {
                $data			= $result3->row_array();
                $rate			= $data['rate'];
                $z			= $gaji_kotor * ($rate / 100);
            }

            $total = $x + $y + $z + $a + $b + $b + $c;

            $data = array(
                'id_karyawan'				=> $karyawan,
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

            $where = array('id_bpjs' => $id_bpjs);
            $this->db->where($where);
            $this->db->update('bpjs_ketenagakerjaan', $data);
            return;
        }
        public function update_bpjs_ketenagakerjaan_redirect($karyawan_id = '') {           
            
            $sqlkaryawan = "SELECT * FROM `bpjs_ketenagakerjaan` WHERE `id_karyawan` = '".$karyawan_id."'";
            $qrykaryawan = $this->db->query($sqlkaryawan);
            if($qrykaryawan->num_rows()>0){
                foreach($qrykaryawan->result() as $datakaryawan){
                    $this->update_bpjs_ketenagakerjaan($karyawan_id,$datakaryawan->id_bpjs, $datakaryawan->jenis_jkk);
                    $this->update_pengajian($karyawan_id);
                }
            }
            
        }
        public function update_bpjs_ketenagakerjaan_redirect_jkk($jkk = '') {           
            
            $sqlkaryawan = "SELECT * FROM `bpjs_ketenagakerjaan` WHERE `jenis_jkk` = '".$jkk."'";
            $qrykaryawan = $this->db->query($sqlkaryawan);
            if($qrykaryawan->num_rows()>0){
                foreach($qrykaryawan->result() as $datakaryawan){
                    $this->update_bpjs_ketenagakerjaan($datakaryawan->id_karyawan, $datakaryawan->id_bpjs, $datakaryawan->jenis_jkk);
                    $this->update_pengajian($datakaryawan->id_karyawan);
                }
            }
            
        }
        public function update_bpjs_ketenagakerjaan_redirect_all() {           
            
            $sqlkaryawan = "SELECT * FROM `bpjs_ketenagakerjaan`";
            $qrykaryawan = $this->db->query($sqlkaryawan);
            if($qrykaryawan->num_rows()>0){
                foreach($qrykaryawan->result() as $datakaryawan){
                    $this->update_bpjs_ketenagakerjaan($datakaryawan->id_karyawan, $datakaryawan->id_bpjs, $datakaryawan->jenis_jkk);
                    $this->update_pengajian($datakaryawan->id_karyawan);
                }
            }
            
        }
        
        public function update_bpjs_kesehatan($id= '',$karyawan = '' ) {

		$result						= $this->db->query("SELECT * FROM karyawan WHERE id = '$karyawan'");

		if ($result->num_rows() > 0) {
			$data			= $result->row_array();
			$id_jabatan		= $data['id_jabatan'];
			$jumlah			= $data['jumlah_keluarga'];

			$result1		= $this->db->query("SELECT * FROM jabatan WHERE id_jabatan = '$id_jabatan'");

			if ($result1->num_rows() > 0) {
				$data			= $result1->row_array();
				$gaji_kotor		= $data['gaji_kotor'];
			}
		}
                else{
                    return;
                }
		$result2		= $this->db->query("SELECT * FROM setting_kesehatan");

		if ($result2->num_rows() > 0) {
			$data				= $result2->row_array();
			$bpjs_perusahaan	= $data['bpjs_perusahaan'];
			$bpjs_karyawan	= $data['bpjs_karyawan'];

			$x				= $gaji_kotor * ($bpjs_perusahaan / 100);
			$y				= $gaji_kotor * (($bpjs_karyawan * $jumlah) / 100);
		}

		$total = $x + $y;

		$data = array(
			'id_karyawan'				=> $karyawan,
			'perhitungan_dasar'			=> $gaji_kotor,
			'bpjs_perusahaan'			=> $x,
			'bpjs_karyawan'				=> $y,
			'total'						=> $total
		);
		$where = array('id_kesehatan' => $id);
                $this->db->where($where);
		$this->db->update('bpjs_kesehatan', $data);
                return;
        }
        public function update_bpjs_kesehatan_redirect($karyawan_id = '') {           
            
            $sqlkaryawan = "SELECT * FROM `bpjs_kesehatan` WHERE `id_karyawan` = '".$karyawan_id."'";
            $qrykaryawan = $this->db->query($sqlkaryawan);
            if($qrykaryawan->num_rows()>0){
                foreach($qrykaryawan->result() as $datakaryawan){
                    $this->update_bpjs_kesehatan($karyawan_id, $datakaryawan->id_kesehatan);
                    $this->update_pengajian($karyawan_id);
                }
            }
            return;            
        }
        public function update_bpjs_kesehatan_redirect_all() {           
            
            $sqlkaryawan = "SELECT * FROM `bpjs_kesehatan`";
            $qrykaryawan = $this->db->query($sqlkaryawan);
            if($qrykaryawan->num_rows()>0){
                foreach($qrykaryawan->result() as $datakaryawan){
                    $this->update_bpjs_kesehatan($datakaryawan->id_karyawan, $datakaryawan->id_kesehatan);
                    $this->update_pengajian($datakaryawan->id_karyawan);
                }
            }
            return;   
            
        }
        public function update_absensi() {
            $datetrans               = date('Y-m');
            $resultabsensi           = $this->db->query("SELECT * FROM absensi WHERE periode_tanggal = '".date('Y-m')."'");

            if ($resultabsensi->num_rows() > 0) {
                $dabsensi		= $resultabsensi->row_array();
                                    
                $id                         = $dabsensi['id_absen'];
                $karyawan                   = $dabsensi['id_karyawan'];
                $sakit	                    = $dabsensi['sakit'];
                $izin           	    = $dabsensi['izin'];
                $tidak_hadir                = $dabsensi['tidak_hadir'];
                $terlambat                  = $dabsensi['terlambat'];
                
                
                $result                     = $this->db->query("SELECT * FROM setting_absensi WHERE id_setting_absensi = '1' limit 1");

                if ($result->num_rows() > 0) {
                        $data			= $result->row_array();
//                        $jam_masuk		= $data['jam_masuk'];
                        $hari_kerja		= $data['hari_kerja'];
                        $potongan_telat	= $data['potongan_telat'];
                        $potongan_alpa	= $data['tidak_hadir'];
                        $potongan_sakit	= $data['sakit'];
                        $potongan_izin	= $data['izin'];

                        $minutes = $terlambat ?: 0;

                        $total	= $hari_kerja - $sakit - $izin - $tidak_hadir;

                        $potongan_absen = ($tidak_hadir * $potongan_alpa) + ($sakit * $potongan_sakit) + ($izin * $potongan_izin) + ($minutes * $potongan_telat);
                }
                $data = array(
                        'id_karyawan'					=> $karyawan,
    //			'jam_hadir'						=> $jam_hadir,
                        'sakit'							=> $sakit,
                        'izin'							=> $izin,
                        'tidak_hadir'                                           => $tidak_hadir,
                        'terlambat'						=> $terlambat,
                        'total'							=> $total,
                        'potongan'						=> $potongan_absen,
                        'periode_tanggal'					=> $datetrans,
                );

                $where = array('id_absen' => $id);
                $this->db->update('absensi', $data, $where);
                $this->update_pengajian($karyawan,$datetrans);
                redirect('admin/absensi');
            }
        }
}
