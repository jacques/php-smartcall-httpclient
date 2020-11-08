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
trait Easypay
{
    /**
     * Authenticate and retrieves the dealer balance in Rands.
     *
     * @param string $paymentIdType  The EasyPay account type ('epNo' for EasyPay number, 'noticeNo' for traffic fines)
     * @param string $paymentIdValue Reference number / account number used for the payment. NOTE that numbers including special characters such as / must first be URL encoded (e.g. / = %2F)
     *
     * @throws \Exception
     *
     * @return array
     */
    public function queryEasypayPayment(string $paymentIdType, string $paymentIdValue): array
    {
        try {
            $response = $this->client->get(
                sprintf(
                    '/webservice/payments/easypay/%s/%s',
                    $paymentIdType,
                    $paymentIdValue
                ),
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );
            var_dump($response);
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

    /**
     * EasyPay payment request.
     *
     * @param string $smartloadId       The dealer Smartload ID (MSISDN) used for the payment transaction
     * @param string $clientReference   The clients reference number associated with the payment to be made
     * @param int    $productId         The Product ID for the payment as found in the product listing. (e.g. 450 for SABC, 451 for Traffic Fines...)
     * @param string $accountType       The EasyPay account type ('epNo' for EasyPay number, 'noticeNo' for traffic fines)
     * @param string $accountReference  The reference number / account number used for the payment
     * @param int    $paymentAmount     The payment amount
     * @param string $paymentCellNumber The cell number of the customer making the payment
     *
     * @throws \Exception
     *
     * @return array
     */
    public function requestEasypayPayment(string $smartloadId, string $clientReference, int $productId, string $accountType, string $accountReference, int $paymentAmount, string $paymentCellNumber): array
    {
        try {
            $response = $this->client->post(
                '/webservice/payments/easypay',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json' => [
                        'smartloadId'       => $smartloadId,
                        'clientReference'   => $clientReference,
                        'productId'         => $productId,
                        'accountType'       => $accountType,
                        'accountReference'  => $accountReference,
                        'paymentAmount'     => $paymentAmount,
                        'paymentCellNumber' => $paymentCellNumber,
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
