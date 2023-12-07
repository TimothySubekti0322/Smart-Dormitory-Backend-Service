<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\API\ResponseTrait;

class AuthorizedService
{
    use ResponseTrait;
    public function authorizeRequest($request)
    {
        $jwtService = new \App\Libraries\JwtService();

        try {
            $authHeader = $request->getServer('HTTP_AUTHORIZATION');
            if (!$authHeader) {
                return [
                    'message' => 'Authorization header not found',
                    'status' => 401
                ]; // Authorization header not found
            }

            list($token) = sscanf($authHeader, 'Bearer %s');
            if (!$token) {
                return [
                    'message' => 'Token not found in the header',
                    'status' => 401
                ]; // Token not found in the header
            }

            $data = $jwtService->decode($token);

            return [
                'message' => 'Token verified',
                'status' => 200,
                'data' => $data
            ]; // Return the decoded token
        } catch (\Exception $e) {
            // Handle decode errors (invalid token, expired, etc.)
            return [
                'message' => $e->getMessage(),
                'status' => 401
            ];
        }
    }
}
