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

class RegisteredTest extends \PHPUnit\Framework\TestCase
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
     * @vcr test_registered_27820000000
     */
    public function testRegistered27820000000()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->registered('27820000000');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","registered":true}';
        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_registered_27829677746
     */
    public function testRegistered27829677746()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->registered('27829677746');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        $expected = '{"error":null,"responseCode":"SUCCESS","registered":true}';
        self::assertEquals($expected, $response['body']);
    }

    /**
     * @vcr test_registered_27820000000__invalid_token
     */
    public function testRegistrationsInvalidToken()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->registered('27820000000');

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
