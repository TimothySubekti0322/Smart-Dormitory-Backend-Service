<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Menu;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;


class MenuController extends BaseController
{
    use ResponseTrait;

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

    private function uploadImage($file)
    {
        $img = $file;
        if (!$img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return [
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'url' => $filepath
            ];
        }
        return [
            'status' => 'error',
            'message' => 'There was an error uploading the image'
        ];
    }

    public function create()
    {
        try {
            $imageFile = $this->request->getFile('file');
            if (!$imageFile) {
                return $this->respond([
                    'status' => 400,
                    'message' => 'Image is required'
                ]);
            }

            // Process the image file and upload to Cloudinary
            $uploadResult = $this->uploadImage($imageFile);
            if ($uploadResult['status'] === 'error') {
                return $this->respond([
                    'status' => 400,
                    'message' => $uploadResult['message']
                ]);
            }


            //Save the data to the database
            $model = new Menu();
            $data = [
                'imgpath' => $uploadResult['url'],
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
        $model = new Menu();
        $data = $model->find($id);

        if (!$data) {
            return $this->respond([
                'status' => 404,
                'message' => 'Menu not found'
            ]);
        }

        // Check if a new image file is provided
        $imageFile = $this->request->getFile('file');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Delete the old image
            $oldImagePath = $data['imgpath'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Upload the new image
            $uploadResult = $this->uploadImage($imageFile);
            if ($uploadResult['status'] === 'error') {
                return $this->respond([
                    'status' => 400,
                    'message' => $uploadResult['message']
                ]);
            }

            // Update the image path in the data array
            $imgFullPath = $uploadResult['url'] . $uploadResult['name'];
            $data['imgpath'] = $imgFullPath;
        }

        // Update the other fields
        $input = $this->request->getRawInput();
        foreach ($input as $key => $value) {
            if (isset($data[$key])) {
                $data[$key] = $value;
            }
        }

        // Update the menu item in the database
        $model->update($id, $data);

        return $this->respond([
            'status' => 200,
            'message' => 'Menu updated successfully'
        ]);
    }


    public function delete($id = null)
    {
        $model = new Menu();
        $data = $model->find($id);

        if ($data) {
            // Extract the image path from the data
            $imgPath = $data['imgpath'];

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
}
