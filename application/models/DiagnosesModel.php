<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class DiagnosesModel extends CI_Model {
  
	public function getDiagnoses()
	{

		$where = [];
		
		$query = $this->db->get_where('diagnoses', $where);

		return $query->result_array();
	}

}