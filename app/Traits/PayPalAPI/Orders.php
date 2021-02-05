<?php

namespace App\Traits\PayPalAPI;

use App\Meta;

trait Orders
{

    public function createOrder($amount, $return_url, $cancel_url, $invoice_id)
    {
        $this->apiEndPoint = "v2/checkout/orders";
        $this->apiUrl = collect([$this->config['api_url'], $this->apiEndPoint])->implode('/');
        $this->verb = 'post';
        $this->options['json'] = [
            'intent' => 'CAPTURE',
            'application_context' =>
            [
                'return_url' => $return_url,
                'cancel_url' => $cancel_url,
                'brand_name' => Meta::where('name', 'name')->first()->value,
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'PAY_NOW',
            ],
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'value' => $amount,
                        'currency_code' => $this->currency,
                    ],
                ],
            ],
            'invoice_id' => $invoice_id,
        ];
        return $this->doPayPalRequest();
    }

    public function authorizeOrder($id)
    {
        $this->apiEndPoint = "v2/checkout/orders/{$id}/authorize";
        $this->apiUrl = collect([$this->config['api_url'], $this->apiEndPoint])->implode('/');
        $this->verb = 'post';
        $this->options['json'] = (object) null;
        return $this->doPayPalRequest();
    }

    public function captureOrder($id)
    {
        $this->apiEndPoint = "v2/checkout/orders/{$id}/capture";
        $this->apiUrl = collect([$this->config['api_url'], $this->apiEndPoint])->implode('/');
        $this->verb = 'post';
        $this->options['json'] = (object) null;
        return $this->doPayPalRequest();
    }

}
