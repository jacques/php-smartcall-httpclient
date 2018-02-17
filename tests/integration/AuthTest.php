<?php
/**
 * SmartCall Restful API (v3) HTTP Client
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2018 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

class AuthTest extends \PHPUnit_Framework_TestCase
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
     * @vcr test_auth
     */
    public function testAuth()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->auth('tap', 'OmDocyoyld^twuz9');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"responseDescription":"Authentication successful","accessToken":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA","tokenType":"Bearer","expiresAt":1518958713558,"scope":"WEBSERVICE_SMARTLOAD_FULL,WEBSERVICE_SMARTRICA_FULL"}', $response['body']);
    }

    /**
     * @vcr test_auth__invalid_username
     * @expectedException GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage Client error: `POST https://www.smartcallesb.co.za:8101/webservice/auth` resulted in a `401 Unauthorized` response:
     * {"responseDescription":"Invalid username","accessToken":null,"tokenType":null,"expiresAt":null,"scope":null}
     */
    public function testAuthInvalidUsername()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->auth('tappy', 'OmDocyoyld^twuz9');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
    }

    /**
     * @vcr test_auth__invalid_password
     * @expectedException GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage Client error: `POST https://www.smartcallesb.co.za:8101/webservice/auth` resulted in a `401 Unauthorized` response:
     * {"responseDescription":"Invalid username","accessToken":null,"tokenType":null,"expiresAt":null,"scope":null}
     */
    public function testAuthInvalidPassword()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->auth('tap', 'sw0rdf1sh');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
    }
}
