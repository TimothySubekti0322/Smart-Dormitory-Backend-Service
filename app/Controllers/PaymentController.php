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
