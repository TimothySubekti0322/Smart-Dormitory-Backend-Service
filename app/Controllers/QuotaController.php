<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\AuthorizedService;

class QuotaController extends BaseController
{
    use ResponseTrait;
    
    protected $authorizedService;

    public function __construct()
    {
        // Instantiate AuthorizedService in the constructor
        $this->authorizedService = new AuthorizedService();
    }

    public function index()
    {
        //
    }

    public function update($id = null)
    {
        $userData = $this->authorizedService->authorizeRequest($this->request);

        if ($userData['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $userData['message']
                ]
            ]);
        }

        $model = new User();
        $data = $model->find($id);

        if (!$data) {
            return $this->failNotFound('No User Found');
        }

        $data['quota'] = $this->request->getVar('quota');
        $model->save($data);
        return $this->respond([
            'status' => 200,
            'messages' => [
                'success' => 'Quota updated'
            ]
        ]);
    }

    public function show($id = null)
    {
        $userData = $this->authorizedService->authorizeRequest($this->request);

        if ($userData['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $userData['message']
                ]
            ]);
        }

        $model = new User();
        $data = $model->find($id);

        if (!$data) {
            return $this->failNotFound('No User Found');
        }

        return $this->respond([
            'status' => 200,
            'data' => $data['quota']
        ]);
    }
}
