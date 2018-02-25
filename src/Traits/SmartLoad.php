<?php
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * PLEASE NOTE: The interface is very fluid while the intial integration
 * is taking place.  It will be refactored in the near future.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2018 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Traits;

trait SmartLoad
{
    /**
     * Authenticate and retrieves the dealer balance in Rands.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function balance($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/balance/%s',
                    $dealerMsisdn
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and request period based cashup reports.
     *
     * @param string $dealerMsisdn
     * @param string $start
     * @param string $end
     *
     * @throws Exception
     *
     * @return array
     */
    public function cashup($dealerMsisdn, $start, $end)
    {
        try {
            $response = $this->post(
                '/webservice/smartload/cashup',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json'    => [
                        'smartloadId' => $dealerMsisdn,
                        'startDate'   => $start,
                        'endDate'     => $end,
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and request current day cashup report.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function cashupToday($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/cashup/%s',
                    $dealerMsisdn
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and request to transfer funds from one Smartload account to another.
     *
     * @param string $fromDealerMsisdn
     * @param string $toDealerMsisdn
     * @param string $amount
     * @param string $sendSms
     *
     * @throws Exception
     *
     * @return array
     */
    public function fundstransfer($fromDealerMsisdn, $toDealerMsisdn, $amount, $sendSms)
    {
        try {
            $response = $this->post(
                '/webservice/smartload/fundstransfer',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json' => [
                        'sourceSmartloadId'    => $fromDealerMsisdn,
                        'recipientSmartloadId' => $toDealerMsisdn,
                        'amount'               => $amount,
                        'sendSms'              => $sendSms,
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and retrieves a list of all available networks.
     *
     * @throws Exception
     *
     * @return array
     */
    public function network($id)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/networks/%d',
                    $id
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and retrieves a list of all available networks.
     *
     * @throws Exception
     *
     * @return array
     */
    public function networks()
    {
        try {
            $response = $this->get(
                '/webservice/smartload/networks',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and recharge prevend request.
     *
     * @param string $dealerMsisdn
     * @param string $clientReference
     * @param string $smsRecipientMsisdn
     * @param string $deviceId
     * @param int    $productId
     * @param int    $amount
     * @param bool   $pinless
     * @param bool   $sendSms
     *
     *
     * {
     * "smartloadId": "27821234567",
     * "clientReference": "abc123",
     * "smsRecipientMsisdn": "27821234567",
     * "deviceId": "27821234567",
     * "productId": 62,
     * "amount": 12,
     * "pinless": true,
     * "sendSms": true
     * }
     */
    public function prevend()
    {
        try {
            $response = $this->post(
                sprintf(
                    '/webservice/smartload/products/%d',
                    $id
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json' => [
                        'smartloadId'        => '',
                        'clientReference'    => '',
                        'smsRecipientMsisdn' => '',
                        'deviceId'           => '',
                        'productId'          => '',
                        'amount'             => '',
                        'pinless'            => '',
                        'sendSms'            => '',
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and retrieves a list of all available networks.
     *
     * @param int $id
     *
     * @throws Exception
     *
     * @return array
     */
    public function products($id)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/products/%d',
                    $id
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and checks if the provided ID (MSISDN) is registered with Smartload.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function registered($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/registered/%s',
                    $dealerMsisdn
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }
}
