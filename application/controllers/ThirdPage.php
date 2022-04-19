<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    include APPPATH.'/controllers/BaseController.php';

    class ThirdPage extends BaseController {

        public function index()
        {
            $this->load->model('UsersModel');
            $this->load->model('DiagnosesModel');
            $this->load->model('UsersDiagnosesModel');

            $data = [];

            $data['title'] = 'Third Page';

            $filters = [];

            foreach ($this->UsersModel->getUsers($filters) as $user) {

                $data['users'][] = [
                    'id' => $user['id'],
                    'patient' => $user['surname'] . ' ' . substr($user['name'], 0, 1) . '. ' . substr($user['patronymic'], 0, 1) . '.',
                ];

            }

            foreach ($this->DiagnosesModel->getDiagnoses() as $diagnose) {

                $data['diagnoses'][] = [
                    'id' => $diagnose['id'],
                    'description' => $diagnose['code'] . ' ' . $diagnose['description']
                ];

            }

            $data['users_diagnoses_id'] = $this->input->get('id');
            $data['action_url'] = isset($data['users_diagnoses_id']) ? site_url('ThirdPage/updateUserDiagnose') : site_url('/ThirdPage/insertDiagnose');
            
            if (isset($data['users_diagnoses_id'])) {
                $user_diagnose_by_id = $this->UsersDiagnosesModel->getUserDiagnoseById($data['users_diagnoses_id']);

                $data['user_diagnose_by_id'] = [
                    'id' => $user_diagnose_by_id['id'],
                    'user_id' => $user_diagnose_by_id['user_id'],
                    'name' => $user_diagnose_by_id['surname'] . ' ' . substr($user_diagnose_by_id['name'], 0, 1) . '. ' . substr($user_diagnose_by_id['patronymic'], 0, 1) . '.',
                    'user_diagnose' => $user_diagnose_by_id['user_diagnose'],
                    'date_opening' => $user_diagnose_by_id['date_opening'],
                    'description' => $user_diagnose_by_id['code'] . ' ' . $user_diagnose_by_id['description']
                ];
            }

            $this->load->template('pages/third_page', compact('data'));

        }

        public function insertDiagnose()
        {
            header('Content-Type: application/json');

            $this->load->library('user_agent');

            $error = false;
    
            if($this->input->server('REQUEST_METHOD') === 'POST'){

                $this->load->model('UsersDiagnosesModel');

                $data = $this->input->post();

                $diagnose_create = [
                    'user_id' => $data['user_id'],
                    'date_opening' => $data['date_opening'],
                    'user_diagnose' => $data['user_diagnose'],
                ];

                $this->UsersDiagnosesModel->insertUserDiagnose($diagnose_create);

                redirect($this->agent->referrer());
            }

            echo json_encode(['error' => false]);
        }

        public function updateUserDiagnose()
        {
            header('Content-Type: application/json');

            $this->load->library('user_agent');

            $error = false;
    
            if($this->input->server('REQUEST_METHOD') === 'POST'){

                $this->load->model('UsersDiagnosesModel');

                $data = $this->input->post();

                $diagnose_update = [
                    'user_id' => $data['user_id'],
                    'user_diagnose' => $data['user_diagnose'],
                    'date_opening' => $data['date_opening'],
                ];

                $this->UsersDiagnosesModel->updateUserDiagnose($data['id'], $diagnose_update);

                redirect($this->agent->referrer());
            }
    
            echo json_encode(['error' => false]);
        }

    }