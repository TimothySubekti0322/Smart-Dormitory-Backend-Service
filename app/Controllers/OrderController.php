<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Order;
use App\Libraries\AuthorizedService;

class OrderController extends BaseController
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
        $model = new Order();
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
        //
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

        if ($userData['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $userData['message']
                ]
            ]);
        }

        $rules = [
            'name' => 'required',
            'roomId' => 'required',
            'phone' => 'required',
            'menuId' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->respond(
                [
                    'status' => 400,
                    'error' => $this->validator->getErrors(),
                ]
            );
        }

        $model = new Order();
        $data = [
            'name' => $this->request->getVar('name'),
            'roomId' => $this->request->getVar('roomId'),
            'phone' => $this->request->getVar('phone'),
            'menuId' => $this->request->getVar('menuId'),
        ];
        $model->insert($data);
        return $this->respond([
            'status' => 201,
            'messages' => [
                'success' => 'Order created successfully'
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
