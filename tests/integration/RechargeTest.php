<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2019 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

class RechargeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @vcr test_recharge_27813272161
     */
    public function testRecharge()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->recharge('27813272161', '9194e809-7cce-4395-b782-5fd4045ce29d', '27831234567', '27831234567', 22, 100, true, true);

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","recharge":{"balance":99574.75,"orderReferenceId":130078272,"ticketNumber":"","boxNumber":"","batchNumber":"","voucherPin":"","expiryDate":null,"retailPrice":"450.00","dealerDiscount":"5.5"}}';
        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_recharge_27813272161_7583b71e
     */
    public function testRecharge7583b71e()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->recharge('27813272161', '7583b71e-a953-4578-aef9-14906237d757', '27831234567', '27831234567', 22, 100, true, true);

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","recharge":{"balance":99149.50,"orderReferenceId":130078273,"ticketNumber":"","boxNumber":"","batchNumber":"","voucherPin":"","expiryDate":null,"retailPrice":"450.00","dealerDiscount":"5.5"}}';
        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_recharge_27813272161_115db509
     */
    public function testRecharge115db509()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->recharge('27813272161', '115db509-372b-45e8-ab7e-aa0a5a5dc95e', '27831234567', '27831234567', 22, 100, true, true);

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(400, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        $expected = new \StdClass();
        $expected->code = 16;
        $expected->message = 'A trx with the same Cell no + amount was done in the last 5 minutes. Please retry in 5 min if valid.';

        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_recharge_27820000000__invalid_token
     */
    public function testRechargeInvalidToken()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->recharge('27820000000', 'e309d658-dc45-4968-9c86-0867dae46e33', '27831234567', '27831234567', 22, 100, true, true);

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
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
