<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtService
{
    protected $key;
    protected $alg;

    public function __construct()
    {
        $this->key = getenv('JWT_SECRET'); // Replace with your secret key
        $this->alg = 'HS256'; // Algorithm used to sign the token
    }

    public function encode($data)
    {
        return JWT::encode($data, $this->key, $this->alg);
    }

    public function decode($token)
    {
        return JWT::decode($token, new Key($this->key, $this->alg));
    }
}
