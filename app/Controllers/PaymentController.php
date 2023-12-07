<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class PaymentController extends BaseController
{
    use ResponseTrait;
    public function index()
    {
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
