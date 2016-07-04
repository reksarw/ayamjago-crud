<?php

class CRUD extends AJ_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->database();
	}
	
	public function getBiodata($biodata_id){
		$query = $this->db->select('biodata')->where("biodata_id = '$biodata_id'");
		
		if ( $this->db->num_rows($query) > 0 )
		{
			return $query->resultOne();
		}else{
			return FALSE;
		}
	}
	
	public function getAllBiodata(){
		$query = $this->db->select('biodata');
		
		return $query->result('object');
	}
	
	public function getRows($table){
		$query = $this->db->query("SELECT * FROM ".$table);
		
		return $this->db->num_rows($query);
	}
	
	public function insertBiodata($nl,$np,$jk,$tgl,$tpl,$almt,$ct,$hb){
		$query = $this->db->insert('biodata');
		$query->values(array(
			'nama_lengkap' => $nl,
			'nama_panggilan' => $np,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tgl,
			'tanggal_lahir' => $tpl,
			'alamat' => $almt,
			'cita_cita' => $ct,
			'hobi' => $hb
		));
		
		return $query->run();
	}
	
	public function deleteBiodata($biodata_id){
		$query = $this->db->delete('biodata');
		$query->where("biodata_id = '$biodata_id'");
		
		return $query->run();
	}
	
	public function updateBiodata($bid,$nl,$np,$jk,$tgl,$tpl,$almt,$ct,$hb){
		$data = array(
			'nama_lengkap' => $nl,
			'nama_panggilan' => $np,
			'jenis_kelamin' => $jk,
			'tempat_lahir' => $tgl,
			'tanggal_lahir' => $tpl,
			'alamat' => $almt,
			'cita_cita' => $ct,
			'hobi' => $hb
		);
		
		$query = $this->db->update('biodata');
		$query->set($data);
		$query->where("biodata_id = '$bid'");
		
		return $query->run();
	}
}