<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {
  
	public function getUsers()
	{
		$query = $this->db->get('users');

        return $query->result_array();
	}

	public function getTotalUsers()
	{
		$query = $this->db->select('COUNT(*) as total')->get('users');
		$total = $query->row_array();

		return $total['total'];
	}

}