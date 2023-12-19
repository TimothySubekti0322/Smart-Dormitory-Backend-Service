<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Libraries\AuthorizedService;

class PaymentController extends BaseController
{
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

            // You might want to set a sbotatus code 204 No Content here
            header('HTTP/1.1 204 No Content');

            // End script execution
            exit;
        }
    }

    public function index()
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

        $qris_request_date = date('Y-m-d H:i:s');
        $invoice_id = $this->generateInvoiceID();
        return $this->respond([
            'status' => 200,
            'message' => 'Success',
            'data' => [
                'qris_request_date' => $qris_request_date,
                'qris_invoiceid' => $invoice_id
            ]
        ]);
    }

    function generateInvoiceID()
    {
        return mt_rand(100000000, 999999999);
    }
}
