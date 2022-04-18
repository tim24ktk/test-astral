<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersDiagnosesModel extends CI_Model {
  
	public function getUsersDiagnoses($data)
	{
		$where = [];
	  
		if (!empty($data['limit'])) {
			$limit = $data['limit'];
		} else {
			$limit = 10;
		}

		if (!empty($data['page'])) {
			$page = $data['page'];
		} else {
			$page = 1;
		}
		if (!empty($data['sort_by'])) {
			$order = $data['order']??'DESC';
			$this->db->order_by($data['sort_by'], $order);
		}

        $this->db->select('ud.id, ud.user_id, u.surname, u.name, u.patronymic, d.code, d.description, ud.user_diagnose, ud.date_opening, ud.date_closing');
        $this->db->join('users as u', 'u.id = ud.user_id', 'left');
        $this->db->join('diagnoses as d', 'd.id = ud.user_diagnose', 'left');

		$query = $this->db->get_where('users_diagnoses as ud', $where, $limit,  ($page-1)*$limit);

        return $query->result_array();
	}

	public function getTotalUsersDiagnoses()
	{
		$query = $this->db->select('COUNT(*) as total')->get('users_diagnoses');
		$total = $query->row_array();

		return $total['total'];
	}

	public function updateUserDiagnose($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('users_diagnoses', $data);
	}

	public function deleteUsersDiagnoses($id){
		$this->db->where('id', $id);
		$this->db->delete('users_diagnoses');
	}

	public function getDiagnoses($data)
	{
		$where = [];

		if(!empty($data['user_diagnose'])) {
			$where['LOWER(code) LIKE'] = '%'.mb_strtolower($data['user_diagnose'], 'UTF-8').'%';
		}

		$query = $this->db->get_where('diagnoses', $where);

		return $query->result_array();
	}

}