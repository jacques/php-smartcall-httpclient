<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2023 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

final class TransactionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @vcr test_transaction_27813272161_pending
     */
    public function testPendingTransactionRecharge(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->transaction('27813272161', '9194e809-7cce-4395-b782-5fd4045ce29d');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","transaction":{"description":"Order","network":"2000 SMS-R450","recipientMsisdn":"27831234567","statusDate":1519580942863,"reference":"130078272","amount":"R450.00","discount":"5.50%","cost":"R425.25","status":"Recharge Pending","statusId":"PENDING","ticketNumber":null,"voucherPin":null,"additionalVoucherPin":null,"boxNumber":null,"batchNumber":null,"expiryDate":null}}';
        self::assertSame($expected, $response['body']);
    }

    /**
     * @vcr test_transaction_27813272161_cancelled
     */
    public function testCancelledTransactionRecharge(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->transaction('27813272161', '9194e809-7cce-4395-b782-5fd4045ce29d');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","transaction":{"description":"Order","network":"2000 SMS-R450","recipientMsisdn":"27831234567","statusDate":1519580942863,"reference":"130078272","amount":"R450.00","discount":"5.50%","cost":"R425.25","status":"Recharge Pending","statusId":"PENDING","ticketNumber":null,"voucherPin":null,"additionalVoucherPin":null,"boxNumber":null,"batchNumber":null,"expiryDate":null}}';
        self::assertSame($expected, $response['body']);
    }

    /**
     * @vcr test_transaction_27813272161_invalid_client_reference
     */
    public function testInvalidClientTeferenceTransactionRecharge(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->transaction('27813272161', 'e309d658-dc45-4968-9c86-0867dae46e33');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('error', $response['status']);
        self::assertSame(400, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        $expected = new \StdClass();
        $expected->code = 1005;
        $expected->message = 'ClientReference does not exist';

        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_transaction_27820000000__invalid_token
     */
    public function testTransactionInvalidToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->transaction('27820000000', 'e309d658-dc45-4968-9c86-0867dae46e33');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        $expected = new \StdClass();
        $expected->responseDescription = 'Authorization denied. Token validation failed';
        $expected->accessToken = null;
        $expected->tokenType = null;
        $expected->expiresAt = null;
        $expected->scope = null;

        self::assertEquals($expected, $response['body']);
    }
}
