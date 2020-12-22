<?php 
// By Larissa Moro 
// https://github.com/LariMoro20
// PHP CodeIgniter 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class status_model extends CI_Model {
	public function __construct()	{
		parent::__construct();
		if(isset($_POST)){ array_walk_recursive($_POST, function(&$v, $k) {$v = (utf8_decode($v));}); }
		if(isset($_GET)){ array_walk_recursive($_GET, function(&$v, $k) {$v = mysqli_real_escape_string($this->db->conn_id,utf8_decode($v));}); }
	}

	public function getStatus($id=false){
		if($id){
			$this->db->where('Id', $id);
		}
		$status = $this->db->get('status')->result();
		return $status;
	}
}
	
?>