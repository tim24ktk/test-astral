<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {
  
	public function getUsers($data)
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
		
		$query = $this->db->get_where('users', $where, $limit,  ($page-1)*$limit);

        return $query->result_array();
	}

	public function getTotalUsers($data)
	{
		$where = [];

		if (!empty($data['user_id'])) {
			$where['id'] = $data['user_id'];
		}
		
		$query = $this->db->select('COUNT(*) as total')->get_where('users', $where);
		$total = $query->row_array();

		return $total['total'];
	}

}