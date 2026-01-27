<?php

namespace App\Services;

use Yabacon\Paystack;

class PaystackService
{
    protected $paystack;

    public function __construct()
    {
        $this->paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));
    }

    public function initializePayment(array $data)
    {
        return $this->paystack->transaction->initialize($data);
    }

    public function verifyPayment(string $reference)
    {
        return $this->paystack->transaction->verify(['reference' => $reference]);
    }
}
