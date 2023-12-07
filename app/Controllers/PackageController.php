<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Package;
use App\Libraries\AuthorizedService;

class PackageController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    use ResponseTrait;

    protected $authorizedService;

    public function __construct()
    {
        // Instantiate AuthorizedService in the constructor
        $this->authorizedService = new AuthorizedService();
    }

    public function index()
    {
        $model = new Package();
        $data = $model->findAll();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Package Found');
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new Package();
        $data = $model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Package Found');
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return $this->respond([
            'status' => 403,
            'messages' => [
                'error' => 'You are not allowed to access this method'
            ]
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $userData = $this->authorizedService->authorizeRequest($this->request);

        // if ($userData['status'] != 200) {
        //     return $this->respond([
        //         'status' => 401,
        //         'messages' => [
        //             'error' => $userData['message']
        //         ]
        //     ]);
        // }



        if ($userData['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        $rules = [
            'name' => 'required',
            'price' => 'required|greater_than[0]',
            'description' => 'required',
            'quota' => 'required|greater_than[0]'
        ];

        if (!$this->validate($rules)) {
            return $this->respond(
                [
                    'status' => 400,
                    'error' => $this->validator->getErrors(),
                ]
            );
        }

        $model = new Package();
        $data = [
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'description' => $this->request->getVar('description'),
            'quota' => $this->request->getVar('quota')
        ];
        $model->insert($data);
        return $this->respond([
            'status' => 201,
            'messages' => [
                'success' => 'Package created successfully'
            ]
        ]);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        return $this->respond([
            'status' => 403,
            'messages' => [
                'error' => 'You are not allowed to edit this package'
            ]
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        return $this->respond([
            'status' => 403,
            'messages' => [
                'error' => 'You are not allowed to update this package'
            ]
        ]);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        return $this->respond([
            'status' => 403,
            'messages' => [
                'error' => 'You are not allowed to delete this package'
            ]
        ]);
    }
}
