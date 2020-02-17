<?php declare(strict_types=1);
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

trait Utilities
{
    /**
     * Gets the current connection status to the various mobile networks.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function health()
    {
        try {
            $response = $this->client->get(
                '/webservice/utilities/health',
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
     * Gets the mobile network on which the SIM is connected.
     *
     * @param string $msisdn
     *
     * @throws \Exception
     *
     * @return array
     */
    public function simnetwork($msisdn)
    {
        try {
            $response = $this->client->get(
                sprintf(
                    '/webservice/utilities/simnetwork/%d',
                    $msisdn
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
