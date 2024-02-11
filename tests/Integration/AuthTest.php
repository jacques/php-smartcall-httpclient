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

final class AuthTest extends \PHPUnit\Framework\TestCase
{
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
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"responseDescription":"Authentication successful","accessToken":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA","tokenType":"Bearer","expiresAt":1518958713558,"scope":"WEBSERVICE_SMARTLOAD_FULL,WEBSERVICE_SMARTRICA_FULL"}', $response['body']);
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
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
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
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
        self::assertInstanceOf('\stdClass', $response['body']);
        self::assertSame('Invalid password', $response['body']->responseDescription);
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
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
        self::assertInstanceOf('\stdClass', $response['body']);
        self::assertSame('Source IP is not authorised', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }
}
