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

class CashupTest extends \PHPUnit\Framework\TestCase
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
     * @vcr test_cashup_27813272161_no_auth
     */
    public function testCashup27813272161NoAuth()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->cashup('27813272161', '2018-10-01', '2018-10-27');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        $expected = new \StdClass();
        $expected->responseDescription = 'Authorization denied. Invalid authorization header';
        $expected->accessToken = null;
        $expected->tokenType = null;
        $expected->expiresAt = null;
        $expected->scope = null;

        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161
     */
    public function testCashup27813272161()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQwNjI1NzAxLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjIyOC4yMC42MiIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTU0MDcxMjEwMSwiaWF0IjoxNTQwNjI1NzAxfQ._gDSG3aBe43Sn5VM8IMWPawWvZfYlrPJmxZT2VJYcDk');
        $response = $client->cashup('27813272161', '2018-10-01', '2018-10-27');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Closing Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":748.5200,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":0.0000}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-01_2018-01-31
     */
    public function testCashup27813272161Jan2018()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQwNjI1NzAxLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjIyOC4yMC42MiIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTU0MDcxMjEwMSwiaWF0IjoxNTQwNjI1NzAxfQ._gDSG3aBe43Sn5VM8IMWPawWvZfYlrPJmxZT2VJYcDk');
        $response = $client->cashup('27813272161', '2018-01-01', '2018-01-31');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Recharges","itemDescription":"CELLC","itemCount":3,"amount":-45.0000,"netAmount":-42.7500,"profit":2.2500},{"groupDescription":"Recharges","itemDescription":"Electricity-Eskom","itemCount":1,"amount":-300.0000,"netAmount":-300.0000,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"MTN","itemCount":3,"amount":-55.0000,"netAmount":-52.2500,"profit":2.7500},{"groupDescription":"Recharges","itemDescription":"Telkom Mobile","itemCount":7,"amount":-447.0000,"netAmount":-420.1800,"profit":26.8200},{"groupDescription":"Recharges","itemDescription":"VOD","itemCount":5,"amount":-83.0000,"netAmount":-78.4500,"profit":4.5500},{"groupDescription":"Deposits","itemDescription":"Credit","itemCount":1,"amount":500.0000,"netAmount":500.0000,"profit":0.0000},{"groupDescription":"Deposits","itemDescription":"Deposit Fee","itemCount":1,"amount":-3.6400,"netAmount":-3.6400,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":36.3700}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161__invalid_token
     */
    public function testCashupInvalidToken()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->cashup('27813272161', '2018-10-01', '2018-10-27');

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
