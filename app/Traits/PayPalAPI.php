<?php

namespace App\Traits;

use App\Traits\PayPalAPI\Orders;
use Srmklive\PayPal\Traits\PayPalAPI\BillingPlans;
use Srmklive\PayPal\Traits\PayPalAPI\CatalogProducts;
use Srmklive\PayPal\Traits\PayPalAPI\Disputes;
use Srmklive\PayPal\Traits\PayPalAPI\DisputesActions;
use Srmklive\PayPal\Traits\PayPalAPI\Invoices;
use Srmklive\PayPal\Traits\PayPalAPI\InvoicesSearch;
use Srmklive\PayPal\Traits\PayPalAPI\InvoicesTemplates;
use Srmklive\PayPal\Traits\PayPalAPI\PaymentAuthorizations;
use Srmklive\PayPal\Traits\PayPalAPI\PaymentCaptures;
use Srmklive\PayPal\Traits\PayPalAPI\PaymentRefunds;
use Srmklive\PayPal\Traits\PayPalAPI\Reporting;
use Srmklive\PayPal\Traits\PayPalAPI\Subscriptions;
use Srmklive\PayPal\Traits\PayPalAPI\Trackers;
use Srmklive\PayPal\Traits\PayPalAPI\WebHooks;
use Srmklive\PayPal\Traits\PayPalAPI\WebHooksEvents;
use Srmklive\PayPal\Traits\PayPalAPI\WebHooksVerification;

trait PayPalAPI
{
    use Trackers;
    use CatalogProducts;
    use Disputes;
    use DisputesActions;
    use Invoices;
    use InvoicesSearch;
    use InvoicesTemplates;
    use Orders;
    use PaymentAuthorizations;
    use PaymentCaptures;
    use PaymentRefunds;
    use BillingPlans;
    use Subscriptions;
    use Reporting;
    use WebHooks;
    use WebHooksVerification;
    use WebHooksEvents;

    /**
     * Login through PayPal API to get access token.
     *
     * @throws \Throwable
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @see https://developer.paypal.com/docs/api/get-an-access-token-curl/
     * @see https://developer.paypal.com/docs/api/get-an-access-token-postman/
     */
    public function getAccessToken()
    {
        $this->apiEndPoint = 'v1/oauth2/token';
        $this->apiUrl = collect([$this->config['api_url'], $this->apiEndPoint])->implode('/');

        $this->options['auth'] = [$this->config['client_id'], $this->config['client_secret']];
        $this->options[$this->httpBodyParam] = [
            'grant_type' => 'client_credentials',
        ];

        $response = $this->doPayPalRequest();

        if (isset($response['access_token'])) {
            $this->setAccessToken($response);

            $this->setPayPalAppId($response);
        }

        return $response;
    }

    /**
     * Set PayPal Rest API access token.
     *
     * @param array $response
     *
     * @return void
     */
    public function setAccessToken($response)
    {
        $this->access_token = $response['access_token'];

        $this->options['headers']['Authorization'] = "{$response['token_type']} {$this->access_token}";
    }

    /**
     * Set PayPal App ID.
     *
     * @param array $response
     *
     * @return void
     */
    private function setPayPalAppId($response)
    {
        if (empty($this->config['app_id'])) {
            $this->config['app_id'] = $response['app_id'];
        }
    }
}
