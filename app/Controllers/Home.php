<?php

namespace App\Controllers;

use Ramsey\Uuid\Uuid;

class Home extends BaseController
{
    public function index()
    {
        return view('intro');
    }

    public function online_simulation()
    {
        if (!session()->get('session_id')) return redirect()->to(base_url('/'));
        return view('main');
    }

    public function simulation_result()
    {
        return view('result');
    }

    public function xhttp_session()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data['key'] == 'make_session') {
            $cekUser = $this->formRegistModel->where(['user_id' => session()->get('user_id')])->first();
            $response = array();
            if ($cekUser) {
                $session_id = Uuid::uuid4();
                session()->set([
                    'session_id' => $session_id,
                ]);

                $response['session_id'] = $session_id;
                $response['status'] = "Success";
            } else {
                $response['status'] = "Failed";
            }
        } else if ($data['key'] == 'reset_session') {

            session()->destroy();

            $response = array();
            $response['status'] = "Success";
        } else {
            $response = array();
            $response['status'] = "Failed";
        }

        $response['name'] = csrf_token();
        $response['value'] = csrf_hash();

        return $this->response->setJSON($response);
    }

    public function xhttp_questdata()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data['key'] == 'get_question') {
            $getSoal = $this->soalModel->orderBy('id')->findAll();

            $response = array();
            $response['question'] = $getSoal;
            $response['status'] = "Success";
        } else {
            $response = array();
            $response['status'] = "Failed";
        }

        $response['name'] = csrf_token();
        $response['value'] = csrf_hash();

        return $this->response->setJSON($response);
    }

    public function xhttp_resultdata()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data['key'] == 'save_result') {
            $dataResult = $this->resultModel->where(['id_user' => session()->get('user_id')])->first();
            if (!$dataResult) {
                $this->resultModel->save([
                    'id_user' => session()->get('user_id'),
                    'result' => $data['result'],
                ]);
                $response = array();
                $response['status'] = "Success";
            } else {
                $response = array();
                $response['status'] = "Success";
            }
            session()->destroy();
        } else {
            $response = array();
            $response['status'] = "failed";
        }

        $response['name'] = csrf_token();
        $response['value'] = csrf_hash();

        return $this->response->setJSON($response);
    }

    public function login_simulation()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data['key'] == 'login_simulation') {
            $response = array();
            $daftrPeserta = $this->formRegistModel->where(['leader_email' => $data['email']])->first();
            if ($daftrPeserta) {
                $resultData = $this->resultModel->where(['id_user' => $daftrPeserta['user_id']])->first();
                if (!$resultData) {
                    if ($data['password'] == $daftrPeserta['leader_phone']) {
                        $response['status'] = "Success";
                        session()->set([
                            'user_id' => $daftrPeserta['user_id'],
                            'email' => $daftrPeserta['leader_email'],
                        ]);
                    } else {
                        $response['status'] = "Failed";
                    };
                } else {
                    $response['status'] = "Failed";
                    $response['limited'] = true;
                }
            } else {
                $response['status'] = "Failed";
            }
        } else {
            $response = array();
            $response['status'] = "Failed";
        }

        $response['name'] = csrf_token();
        $response['value'] = csrf_hash();

        return $this->response->setJSON($response);
    }
}
