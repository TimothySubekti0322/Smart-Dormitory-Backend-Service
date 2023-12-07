<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Menu;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\AuthorizedService;

class MenuController extends BaseController
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
        $model = new Menu();
        $data = $model->findAll();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->respond([
                'tatus' => 404,
                'message' => 'No Menu Found'
            ]);
        }
    }

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

        if ($userData['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        try {
            if (!$this->validate([
                'file' => [
                    'rules' => 'uploaded[file]|max_size[file,6072]|is_image[file]|ext_in[file,jpg,jpeg,png]',
                    'errors' => [
                        'uploaded' => 'No file selected',
                        'max_size' => 'File size too large',
                        'is_image' => 'File is not an image',
                        'ext_in' => 'File type not allowed'
                    ]
                ]
            ])) {
                return $this->respond([
                    'status' => 400,
                    'message' => $this->validator->getErrors()
                ]);
            }

            // Check if the image file is provided


            $imageFile = $this->request->getFile('file');

            $imageFile->move('./uploads');

            if (!$imageFile) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Image is required'
                ]);
            }

            //Save the data to the database
            $model = new Menu();
            $data = [
                'imgpath' => getenv('app.baseUrl') . 'uploads' . '/' . $imageFile->getName(),
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'date' => $this->request->getVar('date'),
                'category' => $this->request->getVar('category')
            ];

            $model->insert($data);
            return $this->respond([
                'status' => 200,
                'messages' => [
                    'success' => 'Menu created'
                ]
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
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

        if ($userData['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        try {
            $model = new Menu();
            $data = $model->find($id);

            if (!$data) {
                return $this->respond([
                    'status' => 404,
                    'message' => 'Menu not found'
                ]);
            }

            if (!$this->validate([
                'file' => [
                    'rules' => 'max_size[file,6072]|is_image[file]|ext_in[file,jpg,jpeg,png]',
                    'errors' => [
                        'max_size' => 'File size too large',
                        'is_image' => 'File is not an image',
                        'ext_in' => 'File type not allowed'
                    ]
                ]
            ])) {
                return $this->respond([
                    'status' => 400,
                    'message' => $this->validator->getErrors()
                ]);
            }

            // Check if a new image file is provided
            $imageFile = $this->request->getFile('file');

            // Proceed only if a file is uploaded
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                // Delete the old image
                $oldImagePath = $this->urlToFilepath($data['imgpath']);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                // Move the new image
                if ($imageFile->move('./uploads')) {
                    // Update the image path in the data array
                    $data['imgpath'] = getenv('app.baseUrl') . 'uploads' . '/' . $imageFile->getName();
                } else {
                    // Handle error
                    return $this->respond([
                        'status' => 400,
                        'message' => 'Could not move the file'
                    ]);
                }
            }

            // Update the other fields
            $name = $this->request->getVar('name');

            if ($name) {
                $data['name'] = $name;
            }

            $description = $this->request->getVar('description');
            if ($description) {
                $data['description'] = $description;
            }

            $date = $this->request->getVar('date');
            if ($date) {
                $data['date'] = $date;
            }

            $category = $this->request->getVar('category');
            if ($category) {
                $data['category'] = $category;
            }


            // Update the menu item in the database
            $model->update($id, $data);

            return $this->respond([
                'status' => 200,
                'message' => 'Menu updated successfully'
            ]);
        } catch (\Exception $e) {
            return $this->respond([
                'status' => 400,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function delete($id = null)
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

        if ($userData['data']->data->role != 'admin') {
            return $this->respond([
                'status' => 403,
                'messages' => [
                    'error' => 'You are not allowed to access this method'
                ]
            ]);
        }

        $model = new Menu();
        $data = $model->find($id);

        if ($data) {
            // Extract the image path from the data
            $imgPath = $this->urlToFilepath($data['imgpath']);

            // Check if the file exists and delete it
            if (file_exists($imgPath)) {
                unlink($imgPath);
            }

            // Delete the menu item from the database
            $model->delete($id);

            return $this->respond([
                'status' => 200,
                'message' => 'Menu and associated image deleted successfully'
            ]);
        } else {
            return $this->respond([
                'status' => 404,
                'message' => 'Menu not found'
            ]);
        }
    }

    public function urlToFilepath($url)
    {
        // Extract the part of the URL after the base URL
        $baseUrl = getenv('app.baseUrl');
        $relativePath = str_replace($baseUrl, '', $url);

        // Define the root directory project
        $rootDirectory = FCPATH;

        // Construct the full file path
        $filePath = $rootDirectory . $relativePath;

        return $filePath;
    }
}
