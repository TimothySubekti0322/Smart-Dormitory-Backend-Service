<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Order;
use App\Models\Menu;
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

        // Enable CORS
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

        // Handle the preflight request for any type of request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // Return only the headers and not the content
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');

            // You might want to set a status code 204 No Content here
            header('HTTP/1.1 204 No Content');

            // End script execution
            exit;
        }
    }

    public function index()
    {
        $auth = $this->authorizedService->authorizeRequest($this->request);

        if ($auth['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $auth['message']
                ]
            ]);
        }

        if ($auth['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        $model = new Order();

        $date = $this->request->getGet('date');
        $category = $this->request->getGet('category');

        if ($date || $category) {
            // Get filtered orders if any query parameters are provided
            $data = $model->getOrdersByDateAndCategory($date, $category);
        } else {
            // Get all orders if no query parameters are provided
            $data = $model->getAllOrders();
        }

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Order Found');
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $auth = $this->authorizedService->authorizeRequest($this->request);

        if ($auth['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $auth['message']
                ]
            ]);
        }

        $model = new Order();
        $data = $model->find($id);

        if (!$data) {
            return $this->respond([
                'status' => 404,
                'messages' => [
                    'error' => 'No Order Found'
                ]
            ]);
        }

        return $this->respond([
            'status' => 200,
            'data' => $data
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $auth = $this->authorizedService->authorizeRequest($this->request);

        if ($auth['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $auth['message']
                ]
            ]);
        }

        $rules = [
            'name' => 'required',
            'userId' => 'required',
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
            'userId' => $this->request->getVar('userId'),
            'roomId' => $this->request->getVar('roomId'),
            'phone' => $this->request->getVar('phone')
        ];

        // check if the user is valid
        $userModel = new \App\Models\User();
        $user = $userModel->find((int) $data['userId']);
        if (!$user) {
            return $this->respond([
                'status' => 404,
                'messages' => [
                    'error' => 'There is no user with id ' . $data['userId'] . ' found'
                ]
            ]);
        }

        $menuId = $this->request->getVar('menuId');

        $menuModel = new Menu();

        for ($i = 0; $i < count($menuId); $i++) {
            // Check if the menuId is valid
            $menu = $menuModel->find((int) $menuId[$i]);
            if (!$menu) {
                return $this->respond([
                    'status' => 404,
                    'messages' => [
                        'error' => 'There is no menu with id ' . $menuId[$i] . ' found'
                    ]
                ]);
            }
            $data['menuId'] = (int)$menuId[$i];
            $model->insert($data);
        }
        return $this->respond([
            'status' => 201,
            'messages' => [
                'success' => 'Order created successfully'
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
        $auth = $this->authorizedService->authorizeRequest($this->request);

        if ($auth['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $auth['message']
                ]
            ]);
        }

        if ($auth['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        $model = new Order();
        $data = $model->find($id);
        if (!$data) {
            return $this->respond([
                'status' => 404,
                'messages' => [
                    'error' => 'No Order Found'
                ]
            ]);
        }
        $model->where('id', $id)->delete($id);
        return $this->respond([
            'status' => 200,
            'messages' => [
                'success' => 'Order successfully deleted'
            ]
        ]);
    }

    public function showHistory($id = null)
    {
        $auth = $this->authorizedService->authorizeRequest($this->request);

        if ($auth['status'] != 200) {
            return $this->respond([
                'status' => 401,
                'messages' => [
                    'error' => $auth['message']
                ]
            ]);
        }

        $model = new Order();
        $data = $model->where('userId', $id)->findAll();

        if (!$data) {
            return $this->respond([
                'status' => 404,
                'messages' => [
                    'error' => 'No Order Found'
                ]
            ]);
        }

        return $this->respond(
            $data
        );
    }
}
