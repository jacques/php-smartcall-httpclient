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

class AuthTest extends \PHPUnit\Framework\TestCase
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
     * @vcr test_auth
     */
    public function testAuth(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $client->setUsername('tap');
        $client->setPAssword('swordfish');
        $response = $client->auth();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"responseDescription":"Authentication successful","accessToken":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA","tokenType":"Bearer","expiresAt":1518958713558,"scope":"WEBSERVICE_SMARTLOAD_FULL,WEBSERVICE_SMARTRICA_FULL"}', $response['body']);
    }

    /**
     * @vcr test_auth__invalid_username
     */
    public function testAuthInvalidUsername(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $client->setUsername('tappy');
        $client->setPAssword('sw0rdf1sh');
        $response = $client->auth();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
    }

    /**
     * @vcr test_auth__invalid_password
     */
    public function testAuthInvalidPassword(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $client->setUsername('tap');
        $client->setPAssword('sw0rdf1sh');
        $response = $client->auth();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\stdClass', $response['body']);
        self::assertEquals('Invalid password', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }

    /**
     * @vcr test_auth__invalid_source_ip
     */
    public function testAuthInvalidSourceIP(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $client->setUsername('tap');
        $client->setPAssword('sw0rdf1sh');
        $response = $client->auth();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\stdClass', $response['body']);
        self::assertEquals('Source IP is not authorised', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }
}
