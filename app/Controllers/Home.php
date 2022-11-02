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
        if (!session()->get('session_id')) return redirect()->to(base_url('/'));
        return view('result');
    }

    public function createSession()
    {
        $session_id = Uuid::uuid4();

        session()->set([
            'session_id' => $session_id,
        ]);

        $response = array();
        $response['session_id'] = $session_id;
        $response['status'] = "Success";
        $response['name'] = csrf_token();
        $response['value'] = csrf_hash();

        return $this->response->setJSON($response);
    }
}
