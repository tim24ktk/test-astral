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

            $filters = [];

            $filters['id'] = $this->input->get('id');

            if($this->input->get('patient')) {
                $filters['patient'] = $this->input->get('patient');
            }

            $records = $this->UsersDiagnosesModel->getTotalUsersDiagnoses();
            $total = ceil($records/10);
            $page = $this->input->get('page')?($this->input->get('page')<=$total?$this->input->get('page'):$total):1;
    
            $filters['page'] = $page;
            $filters['limit'] = '10';

    
            $sidx = $this->input->get('sidx')?$this->input->get('sidx'):'id';
            $filters['sort_by'] = $sidx;
            $sord = $this->input->get('sord')?strtoupper($this->input->get('sord')):'DESC';
            $filters['order'] = $sord;

            $user_diagnoses = [];

            foreach ($this->UsersDiagnosesModel->getUsersDiagnoses($filters) as $user_diagnose) {

                $user_diagnoses[] = [
                    'id' => $user_diagnose['id'],
                    'user_id' => $user_diagnose['user_id'],
                    'patient' => $user_diagnose['surname'] . ' ' . substr($user_diagnose['name'], 0, 1) . '. ' . substr($user_diagnose['patronymic'], 0, 1) . '.',
                    'code' => $user_diagnose['code'] ?? '',
                    'description' => $user_diagnose['description'] ?? '',
                    'user_diagnose' => $user_diagnose['user_diagnose'],
                    'date_opening' => $user_diagnose['date_opening'],
                    'date_closing' => $user_diagnose['date_closing']
                ];
            }

            echo json_encode(['rows' => $user_diagnoses, 'records' => $records, 'total' => $total, 'page' => $page]);
        }

        public function updateUserDiagnose()
        {
            header('Content-Type: application/json');

            $error = false;
    
            if($this->input->server('REQUEST_METHOD') === 'POST'){

                $this->load->model('UsersDiagnosesModel');

                $data = $this->input->post();

                $diagnose_update = [
                    'user_diagnose' => $data['user_diagnose'],
                    'date_closing' => $data['date_closing'],
                ];

                $this->UsersDiagnosesModel->updateUserDiagnose($data['id'], $diagnose_update);
            }
    
            echo json_encode(['error' => false]);
        }

        public function delete()
        {
            header('Content-Type: application/json');

            $this->load->model('UsersDiagnosesModel');

            $error = false;
    
            if($this->input->server('REQUEST_METHOD') === 'POST'){
                $this->load->model('UsersDiagnosesModel');
                
                $data = $this->input->post();

                $this->UsersDiagnosesModel->deleteUsersDiagnoses($data['id']);
            }
    
            echo json_encode(['error' => false]);
        }

        public function autocomplete() {
            header('Content-Type: application/json');

            $this->load->model('UsersDiagnosesModel');

            $filters = [];

            if($this->input->get('user_diagnose')) {
                $filters['user_diagnose'] = $this->input->get('user_diagnose');
            }

            $diagnoses = [];

            foreach ($this->UsersDiagnosesModel->getDiagnoses($filters) as $diagnose) {
                $diagnoses[] = [
                    'id' => $diagnose['id'],
                    'value' => $diagnose['code'] . ' ' . $diagnose['description']
                ];
            }

            echo json_encode($diagnoses);
        }

        public function autocompleteUsers() {
            header('Content-Type: application/json');

            $this->load->model('UsersModel');

            $filters = [];

            if($this->input->get('user_surname')) {
                $filters['user_surname'] = $this->input->get('user_surname');
            }

            $users = [];

            foreach ($this->UsersModel->getUsers($filters) as $user) {
                $users[] = [
                    'id' => $user['id'],
                    'label' => $user['surname'] . ' ' . substr($user['name'], 0, 1) . '. ' . substr($user['patronymic'], 0, 1) . '.',
                    'value' => $user['surname'] . ' ' . substr($user['name'], 0, 1) . '. ' . substr($user['patronymic'], 0, 1) . '.'
                ];
            }

            echo json_encode($users);
        }

    }