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

class AuthTokenTest extends \PHPUnit_Framework_TestCase
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
     * @vcr test_auth_token
     */
    public function testAuthToken()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->authToken('tap', 'OmDocyoyld^twuz9');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"availableTokens":18}', $response['body']);
    }

    /**
     * @vcr test_auth_token__invalid_username
     * @expectedException GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage Client error: `GET https://www.smartcallesb.co.za:8101/webservice/auth/token` resulted in a `401 Unauthorized` response:
     * {"responseDescription":"Invalid username","accessToken":null,"tokenType":null,"expiresAt":null,"scope":null}
     */
    public function testAuthTokenInvalidUsername()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->authToken('tappy', 'swordfish');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
    }

    /**
     * @vcr test_auth_token__invalid_password
     * @expectedException GuzzleHttp\Exception\ClientException
     * @expectedExceptionMessage Client error: `GET https://www.smartcallesb.co.za:8101/webservice/auth/token` resulted in a `401 Unauthorized` response:
     * {"responseDescription":"Invalid username","accessToken":null,"tokenType":null,"expiresAt":null,"scope":null}
     */
    public function testAuthTokenInvalidPassword()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);
        $response = $client->authToken('tap', 'sw0rdf1sh');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
    }
}
