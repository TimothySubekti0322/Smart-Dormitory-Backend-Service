<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use \App\Models\User;

class Register extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required',
            'roomId' => 'required|is_unique[users.roomId]',
            'password' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'roomId' => $this->request->getVar('roomId'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role') == 'admin' ? 'admin' : 'user',
            ];

            $userModel = new User;

            $userModel->insert($data);

            return $this->respond([
                'message' => 'Registration Success',
                'status' => 201,
            ], 201);
        }
        return $this->respond([
            'message' => $this->validator->getErrors(),
            'status' => 400
        ], 400);
    }
}
