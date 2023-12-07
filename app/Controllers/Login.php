<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;


class Login extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new User;

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return $this->respond([
                'status' => 404,
                'message' => 'Email not found'
            ], 404);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->respond([
                'status' => 401,
                'message' => 'Password not match'
            ], 401);
        }

        $key = getenv('JWT_SECRET');

        $iat = time();
        $exp = $iat + (3600 * 60);

        $payload = [
            'iss' => 'c14-jwt',
            'aud' => 'logintoken',
            'iat' => $iat,
            'exp' => $exp,
            'data' => [
                'id' => $user['id'],
                'name' => $user['username'],
                'email' => $user['email'],
                'quota' => $user['quota'],
                'role' => $user['role'],
            ]
        ];

        $token = JWT::encode($payload, $key, "HS256");

        return $this->respond([
            'message' => "Login success",
            'payload' => $payload['data'],
            'token' => $token,
            'status' => 200,
        ], 200);
    }
}
