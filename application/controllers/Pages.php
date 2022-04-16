<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    include APPPATH.'/controllers/BaseController.php';

    class Pages extends BaseController {

        public function index()
        {
            $this->load->database();
            $this->load->model('UsersModel');

            $data = [];

            $data['title'] = 'Main Page';


            $this->load->template('pages/index', compact('data'));
        }

        public function getList()
        {
            header('Content-Type: application/json');

            $this->load->model('UsersModel');



            $records = $this->UsersModel->getTotalUsers();
            $total = ceil($records/10);

            $page = $this->input->get('page')?($this->input->get('page')<=$total?$this->input->get('page'):$total):1;

            $filters = [];
    
            $filters['page'] = $page;
            $filters['limit'] = '10';
    
            $sidx = $this->input->get('sidx')?$this->input->get('sidx'):'id';
            $filters['sort_by'] = $sidx;
            $sord = $this->input->get('sord')?strtoupper($this->input->get('sord')):'DESC';
            $filters['order'] = $sord;

            $users = [];

            foreach ($this->UsersModel->getUsers() as $user) {
                $users[] = [
                    'id' => $user['id'],
                    'surname' => $user['surname'],
                    'name' => $user['name'],
                    'patronymic' => $user['patronymic'],
                    'gender' => $user['gender'],
                    'date_birth' => $user['date_birth'],
                    'date_death' => $user['date_death'],
                ];
            }

            echo json_encode(['rows' => $users, 'records' => $records, 'total' => $total, 'page' => $page]);
        }

    }