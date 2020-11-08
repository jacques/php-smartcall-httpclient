<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * PLEASE NOTE: The interface is very fluid while the intial integration
 * is taking place.  It will be refactored in the near future.
 *
 * @author Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license MIT
 */
namespace Jacques\Smartcall\HttpClient\Traits;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
trait Dstv
{
    /**
     * DSTV account query.
     *
     * @param string $accountType      The DSTV account type ('SUBS' for normal subscription, 'TVOD' for BoxOffice)
     * @param string $accountReference Reference number / account number used for the payment. This can be a subscribers ID number or DSTV account number.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function queryDstvPayment(string $accountType, string $accountReference)
    {
        try {
            $response = $this->client->get(
                sprintf(
                    '/webservice/payments/dstv/%s/%s',
                    $accountType,
                    $$accountReference
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
        } catch (ClientException $e) {
            return $this->clientError($e);
        } catch (ServerException $e) {
            return $this->parseError($e);
        }
    }
}
