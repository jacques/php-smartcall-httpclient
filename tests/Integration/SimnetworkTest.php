<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2024 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

final class SimnetworkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @vcr test_simnetwork_no_auth
     */
    public function testSimNetworkNoAuth(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->simnetwork('27813272161');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
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
     * @vcr test_simnetwork_27813272161
     */
    public function testSimNetworkTC(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQwNjI1NzAxLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjIyOC4yMC42MiIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTU0MDcxMjEwMSwiaWF0IjoxNTQwNjI1NzAxfQ._gDSG3aBe43Sn5VM8IMWPawWvZfYlrPJmxZT2VJYcDk');
        $response = $client->simnetwork('27813272161');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"msisdn":"27813272161","queryDate":"2018-10-27 09:46:51","ported":true,"network":"Telkom Mobile","error":null}', $response['body']);
    }

    /**
     * @vcr test_simnetwork_27833530837
     */
    public function testSimNetworkOldMTN(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQwNjI1NzAxLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjIyOC4yMC42MiIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTU0MDcxMjEwMSwiaWF0IjoxNTQwNjI1NzAxfQ._gDSG3aBe43Sn5VM8IMWPawWvZfYlrPJmxZT2VJYcDk');
        $response = $client->simnetwork('27833530837');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"msisdn":"27833530837","queryDate":"2018-10-27 11:11:22","ported":false,"network":"MTN","error":null}', $response['body']);
    }

    /**
     * @vcr test_simnetwork_27813272161__invalid_token
     */
    public function testSimNetworkInvalidToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->simnetwork('27813272161');

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
