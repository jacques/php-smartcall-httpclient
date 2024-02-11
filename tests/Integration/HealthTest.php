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

final class HealthTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @vcr test_health
     */
    public function testHealth(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQ5MDEzOTg4LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjE4Ni45NS4xODgiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1NDkxMDAzODgsImlhdCI6MTU0OTAxMzk4OH0.5b6-yc7V2Iu3z-4_rGQEc9au7Kv_Jgp2WUCQg5tFnNA');
        $response = $client->health();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"vodacom":"UP","mtn":"UP","cellc":"UP","telkom":"UP","virgin":"UP"}', $response['body']);
    }

    /**
     * @vcr test_health__without_bearer_token
     */
    public function testHealthWithoutBearerToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->health();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        self::assertSame('Authorization denied. Invalid authorization header', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }

    /**
     * @vcr test_health__with_expired_bearer_token
     */
    public function testHealthWithExpiredBearerToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTQ5MDEzOTg4LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTA1LjE4Ni45NS4xODgiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1NDkxMDAzODgsImlhdCI6MTU0OTAxMzk4OH0.5b6-yc7V2Iu3z-4_rGQEc9au7Kv_Jgp2WUCQg5tFnNA');
        $response = $client->health();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('error', $response['status']);
        self::assertSame(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        self::assertSame('Authorization denied. Token validation failed', $response['body']->responseDescription);
        self::assertNull($response['body']->accessToken);
        self::assertNull($response['body']->tokenType);
        self::assertNull($response['body']->expiresAt);
        self::assertNull($response['body']->scope);
    }
}
