<?php

declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * PLEASE NOTE: The interface is very fluid while the intial integration
 * is taking place.  It will be refactored in the near future.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2019 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Traits;

trait SmartRica
{
    public function changeownership(): array
    {
        try {
            $response = $this->client->post(
                '/webservice/smartrica/changeownership',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => [
                        'agentId'                => '27821234567',
                        'firstName'              => 'Jane',
                        'surname'                => 'Doe',
                        'idDetails'              => null,
                        'registrationType'       => null,
                        'subscriberId'           => '8911000000010240123456',
                        'last4Iccid'             => '3456',
                        'residentialAddress'     => null,
                        'previousIdNumber'       => null,
                        'previousIdType'         => null,
                        'network'                => null,
                        'businessOwnerIdDetails' => null,
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

    public function registrations(): array
    {
        try {
            $response = $this->client->post(
                '/webservice/smartrica/registrations',
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
