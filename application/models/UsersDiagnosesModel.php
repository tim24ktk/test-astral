<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersDiagnosesModel extends CI_Model {
  
	public function getUsersDiagnoses()
	{
        $this->db->select('ud.id, ud.user_id, u.surname, u.name, u.patronymic, d.code, d.description, ud.date_opening, ud.date_closing');
        $this->db->join('users as u', 'u.id = ud.user_id', 'left');
        $this->db->join('diagnoses as d', 'd.id = ud.user_diagnose', 'left');

		$query = $this->db->get('users_diagnoses as ud');

        return $query->result_array();
	}

	public function getTotalUsersDiagnoses()
	{
		$query = $this->db->select('COUNT(*) as total')->get('users_diagnoses');
		$total = $query->row_array();

		return $total['total'];
	}

	public function deleteUsersDiagnoses($id){
		$this->db->where('id', $id);
		$this->db->delete('users_diagnoses');
	}
}