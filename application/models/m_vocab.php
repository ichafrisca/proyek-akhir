<?php
	class M_vocab extends CI_Model{
		public function ambil_vocab(){
			$queryvocab=$this->db->query("SELECT j.idjadwal, j.jam, j.tanggal, r.namaruang, s.nmsubprog, s.durasi, p.nmprogram
                                            FROM jadwal j JOIN absensi a ON ( j.idjadwal = a.idjadwal ) JOIN ruang r ON ( a.idruang = r.idruang ) join subprogram s on (s.idruang = r.idruang) JOIN program p ON (s.idprogram = p.idprogram) WHERE p.idprogram LIKE 'VC%'");
			return $queryvocab;
    	}
    }
?>