<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class QuotaController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        //
    }

    public function update($id = null)
    {
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
