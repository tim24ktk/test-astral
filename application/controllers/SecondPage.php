<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    include APPPATH.'/controllers/BaseController.php';

    class SecondPage extends BaseController {

        public function index()
        {

            $data = [];

            $data['title'] = 'Second Page';

            $this->load->template('pages/second_page', compact('data'));

        }

        public function getList()
        {
            header('Content-Type: application/json');

            $this->load->model('UsersDiagnosesModel');

            $records = $this->UsersDiagnosesModel->getTotalUsersDiagnoses();
            $total = ceil($records/10);
            $page = $this->input->get('page')?($this->input->get('page')<=$total?$this->input->get('page'):$total):1;

            $filters = [];
    
            $filters['page'] = $page;
            $filters['limit'] = '10';
    
            $sidx = $this->input->get('sidx')?$this->input->get('sidx'):'id';
            $filters['sort_by'] = $sidx;
            $sord = $this->input->get('sord')?strtoupper($this->input->get('sord')):'DESC';
            $filters['order'] = $sord;

            $user_diagnoses = [];

            foreach ($this->UsersDiagnosesModel->getUsersDiagnoses() as $user_diagnose) {

                $user_diagnoses[] = [
                    'id' => $user_diagnose['id'],
                    'user_id' => $user_diagnose['user_id'],
                    'patient' => $user_diagnose['surname'] . ' ' . substr($user_diagnose['name'], 0, 1) . '. ' . substr($user_diagnose['patronymic'], 0, 1) . '.',
                    'user_diagnose' => $user_diagnose['code'] . ' ' . $user_diagnose['description'],
                    'date_opening' => $user_diagnose['date_opening'],
                    'date_closing' => $user_diagnose['date_closing']
                ];
            }

            echo json_encode(['rows' => $user_diagnoses, 'records' => $records, 'total' => $total, 'page' => $page]);
        }

        public function delete()
        {
            header('Content-Type: application/json');
            $error = false;
    
            if($this->input->server('REQUEST_METHOD') === 'POST'){
                $this->load->model('UsersDiagnosesModel');
                
                $data = $this->input->post();

                $this->UsersDiagnosesModel->deleteUsersDiagnoses($data['id']);
            }
    
            echo json_encode(['error' => false]);
        }
    }