<?php
	class M_gaji extends CI_Model{

		public function ambil_gaji() {
			$querygaji=$this->db->query("SELECT g.idgaji, g.dr_tgl, g.ke_tgl, g.jml_pertemuan, g.bonus, 
						g.totalgaji, p.nama, p.no_telp, p.idpeg from gaji g join pegawai p on (g.idpeg=p.idpeg) 
						where MONTHNAME(g.dr_tgl) = MONTHNAME(curdate())");
			return $querygaji;
		}

		public function total_gaji() {
            return $this->db->count_all('gaji');
        }

        public function total_nominal() {
            return $this->db->count_all('list_nominal');
        }

		public function ambil_gaji_display($p=0, $jumlah=5) {
			$sql="SELECT g.idgaji, g.dr_tgl, g.ke_tgl, g.jml_pertemuan, g.bonus, 
						g.totalgaji, p.nama, p.no_telp, p.idpeg from gaji g join pegawai p on (g.idpeg=p.idpeg)";
			$sql.=" limit $p, $jumlah";
            $querygaji=$this->db->query($sql);
			return $querygaji;
		}

		public function hapus($idnominal){
			$this->db->where('idlistnominal',$idnominal);
			$this->db->delete('list_nominal');
		}

		public function hapusgaji($idgaji){
			$this->db->where('idgaji',$idgaji);
			$this->db->delete('gaji');
		}

		public function edit_nominal($nominal){
            $this->db->where('idlistnominal',$nominal);
            $queryeditnominal=$this->db->get('list_nominal');
            return $queryeditnominal;
        }

        public function edit($data, $nominal){
            $this->db->where('idlistnominal',$nominal);
            $this->db->update('list_nominal',$data);
        }

		public function tampil_id() {
			$maxGJ = $this->db->query('SELECT MAX( SUBSTR( idgaji, 4, 4 ) ) AS MAXID FROM gaji');
			return $maxGJ;
		}

		public function tampil_NM() {
			$maxNM = $this->db->query('SELECT MAX( SUBSTR( idlistnominal, 4, 4 ) ) AS MAXID FROM list_nominal');
			return $maxNM;
		}

		public function tambah_gaji($gaji){
			$this->db->insert('GAJI', $gaji);
		}

		public function ambil_nominal($p=0, $jumlah=5){
			$sql = "SELECT l.idlistnominal, l.lisnominal, s.nmsubprog from list_nominal l join subprogram s on(l.idsubprog=s.idsubprog)";
			$sql.=" limit $p, $jumlah";
            $querynominal=$this->db->query($sql);
			return $querynominal;
		}

		public function listnominal($lnominal){
			$this->db->insert('LIST_NOMINAL', $lnominal);
		}

		public function memiliki($memiliki){
			$this->db->insert('MEMILIKI', $memiliki);
		}

		public function tampil_data_nmpegawai(){
        	return $this->db->query("SELECT * from pegawai where stat_peg='Aktif'");
        }

		public function tampil_nominal(){
        	return $this->db->query('SELECT * FROM subprogram');	
        }

        
        public function detailgaji($idpegawai, $tgl_Awal, $tgl_Akhir){
        	$detailgaji = $this->db->query("SELECT p.nama as nama, s.nmsubprog as kelas, 
					(select l.lisnominal from list_nominal l join subprogram k on (l.idsubprog=k.idsubprog) 
					where k.nmsubprog = s.nmsubprog) as honor, a.tgl_absen as tanggal, a.idpeg_pengganti as pengganti
        			from absensi a join pegawai p on (a.idpeg=p.idpeg) join jadwal j on(a.idjadwal=j.idjadwal) 
					join subprogram s on (j.idsubprog=s.idsubprog)
					where a.idpeg='$idpegawai' and a.idpeg_pengganti='Tidak Ada' and a.tgl_absen between '$tgl_Awal' 
					and '$tgl_Akhir'
					union
					select p.nama as nama, s.nmsubprog as kelas, 
					(select l.lisnominal from list_nominal l join subprogram k on (l.idsubprog=k.idsubprog) 
					where k.nmsubprog = s.nmsubprog) as honor, a.tgl_absen as tanggal, a.idpeg_pengganti as pengganti
					from absensi a join pegawai p on (a.idpeg=p.idpeg) join jadwal j on(a.idjadwal=j.idjadwal) 
					join subprogram s on (j.idsubprog=s.idsubprog) 
					where  a.idpeg_pengganti='$idpegawai' and a.tgl_absen between '$tgl_Awal' 
					and '$tgl_Akhir'")->result_array();
			return $detailgaji;
        }

        public function jml_pertemuan($idpeg,$tglawal,$tglakhir){
        	return $this->db->query("SELECT count(idpeg) as total_hadir from absensi where idpeg='$idpeg' 
					and idpeg_pengganti = 'Tidak Ada' and tgl_absen between '$tglawal' and '$tglakhir'
					union all
					select count(idpeg) from absensi where idpeg_pengganti='$idpeg' and tgl_absen
					between '$tglawal' and '$tglakhir'");
        }

        public function total_gaji_karyawan($id,$tgl_awal, $tgl_akhir){
        	return $this->db->query("SELECT sum((select l.lisnominal from list_nominal l join subprogram k on
	        		(l.idsubprog=k.idsubprog) where k.nmsubprog = s.nmsubprog)) as 'total_honor'
	        		from absensi a join pegawai p on (a.idpeg=p.idpeg) join jadwal j on(a.idjadwal=j.idjadwal) 
	        		join subprogram s on (j.idsubprog=s.idsubprog) where a.idpeg='$id' 
	        		and a.idpeg_pengganti='Tidak Ada' and a.tgl_absen between '$tgl_awal' and '$tgl_akhir'
	        		union all
	        		select sum((select l.lisnominal from list_nominal l join subprogram k on (l.idsubprog=k.idsubprog) 
					where k.nmsubprog = s.nmsubprog)) as honor 
        			from absensi a join pegawai p on (a.idpeg=p.idpeg) join jadwal j on(a.idjadwal=j.idjadwal) 
					join subprogram s on (j.idsubprog=s.idsubprog) where a.idpeg_pengganti='$id' 
					and a.tgl_absen between '$tgl_awal' and '$tgl_akhir'")->result_array();
		}

		public function sms_gaji($idpeg){
			$this->db->query("SELECT g.dr_tgl, g.ke_tgl, g.totalgaji from gaji g join pegawai p on(g.idpeg=p.idpeg) where p.idpeg='$idpeg'");
		}

		public function sms_pemberitahuan_gaji($nomor, $nama, $tanggalawal, $tanggalakhir, $jml_pertemuan, $totalgaji){
            $this->db->query("INSERT into outbox (DestinationNumber,TextDecoded) 
                VALUES ('$nomor', 'Saudara $nama, total gaji anda dari tanggal $tanggalawal sampai tanggal $tanggalakhir dengan jumlah pertemuan $jml_pertemuan, adalah sebesar $totalgaji')");
        }

        public function nomor_pegawai(){
            return $this->db->query("SELECT no_telp from pegawai where stat_peg='Aktif'")->result_array();
        }
	}