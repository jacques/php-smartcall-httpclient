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

final class PrevendTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @vcr test_prevend_27813272161
     */
    public function testPrevend(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->prevend('27813272161', '8184e809-7cce-4395-b782-5fd4045ce29d', '27831234567', '27831234567', 22, 100, true, true);

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        $expected = '{"responseCode":"APP_ERROR","message":"No universal account"}';
        self::assertSame($expected, $response['body']);
    }

    /**
     * @vcr test_prevend_27813272161_duplicate_prevend
     */
    public function testPrevendDuplicatePrevend(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE5NTU1OTE5LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTY4LjE0MSIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTY0MjMxOSwiaWF0IjoxNTE5NTU1OTE5fQ._sQJ99CKM0xrESpe9bneiQP7B_UJEg8SHB9rjwRqJFI');
        $response = $client->prevend('27813272161', '8184e809-7cce-4395-b782-5fd4045ce29d', '27831234567', '27831234567', 22, 100, true, true);

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        $expected = '{"responseCode":"SYS_ERROR","message":"Violation of PRIMARY KEY constraint \'PK_VOD_IN_PREVEND\'. Cannot insert duplicate key in object \'dbo.VOD_IN_PREVEND\'. The duplicate key value is (8184e809-7cce-4395-b782-5fd4045ce29d, 1722963)."}';
        self::assertSame($expected, $response['body']);
    }

    /**
     * @vcr test_prevend_27820000000__invalid_token
     */
    public function testPrevendInvalidToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->prevend('27820000000', 'e309d658-dc45-4968-9c86-0867dae46e33', '27831234567', '27831234567', 22, 100, true, true);

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
