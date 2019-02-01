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

class HealthTest extends \PHPUnit\Framework\TestCase
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
     * @vcr test_health
     */
    public function testHealth()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQ5MDEzOTg4LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjE4Ni45NS4xODgiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1NDkxMDAzODgsImlhdCI6MTU0OTAxMzk4OH0.5b6-yc7V2Iu3z-4_rGQEc9au7Kv_Jgp2WUCQg5tFnNA');
        $response = $client->health();

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"vodacom":"UP","mtn":"UP","cellc":"UP","telkom":"UP","virgin":"UP"}', $response['body']);
    }

    /**
     * @vcr test_health__without_bearer_token
     */
    public function testHealthWithoutBearerToken()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->health();

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        self::assertEquals('Authorization denied. Invalid authorization header', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }

    /**
     * @vcr test_health__with_expired_bearer_token
     */
    public function testHealthWithExpiredBearerToken()
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQ5MDEzOTg4LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjE4Ni45NS4xODgiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1NDkxMDAzODgsImlhdCI6MTU0OTAxMzk4OH0.5b6-yc7V2Iu3z-4_rGQEc9au7Kv_Jgp2WUCQg5tFnNA');
        $response = $client->health();

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        self::assertEquals('Authorization denied. Token validation failed', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }
}
