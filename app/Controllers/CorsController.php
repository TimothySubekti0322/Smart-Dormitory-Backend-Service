<?php

// CorsController.php
namespace App\Controllers;

use CodeIgniter\Controller;

class CorsController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function preflight()
    {
        // Set CORS headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        // Send 200 OK status for preflight requests
        $this->output->set_status_header(200);
        // End script execution
        exit();
    }
}
