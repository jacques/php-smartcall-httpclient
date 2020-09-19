<?php

declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

class AuthFlushTest extends \PHPUnit\Framework\TestCase
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
     * @vcr test_auth_token_flush
     */
    public function testAuthFlush(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTU2ODM2LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTA0MzIzNiwiaWF0IjoxNTE4OTU2ODM2fQ.TXsPsowXOTQHwMQgwm4R9__6CDJWj-EQp0-12n4imyE');
        $response = $client->authFlush();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"availableTokens":20}', $response['body']);
    }

    /**
     * @vcr test_auth_token_flush__basic_auth
     */
    public function testAuthFlushBasicAuth(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->authFlush('tap', 'swordfish');

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"availableTokens":20}', $response['body']);
    }

    /**
     * @vcr test_auth_token_flush__already_deleted
     */
    public function testAuthFlushAlreadyFlushd(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->authFlush();

        self::assertIsArray($response);
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
