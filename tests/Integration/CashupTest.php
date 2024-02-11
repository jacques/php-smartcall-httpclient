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

final class CashupTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @vcr test_cashup_27813272161_2018-01-01_2018-01-31
     */
    public function testCashup(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-01', '2018-01-31');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Opening Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":534.7500,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"Electricity-Eskom","itemCount":1,"amount":-300.0000,"netAmount":-300.0000,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"MTN","itemCount":2,"amount":-45.0000,"netAmount":-42.7500,"profit":2.2500},{"groupDescription":"Recharges","itemDescription":"Telkom Mobile","itemCount":4,"amount":-238.0000,"netAmount":-223.7200,"profit":14.2800},{"groupDescription":"Recharges","itemDescription":"VOD","itemCount":1,"amount":-29.0000,"netAmount":-27.4100,"profit":1.5900},{"groupDescription":"Deposits","itemDescription":"Credit","itemCount":1,"amount":500.0000,"netAmount":500.0000,"profit":0.0000},{"groupDescription":"Deposits","itemDescription":"Deposit Fee","itemCount":1,"amount":-3.6400,"netAmount":-3.6400,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":18.1200}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-29_2018-01-29
     */
    public function testCashupSingleDay(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-29', '2018-01-29');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":null}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-01_2018-01-01
     */
    public function testCashupSingleDay01Jan2018(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-01', '2018-01-01');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Opening Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":534.7500,"profit":0.0000},{"groupDescription":"Closing Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":534.7500,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":0.0000}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-02_2018-01-02
     */
    public function testCashupSingleDay02Jan2018(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-02', '2018-01-02');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Opening Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":534.7500,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"MTN","itemCount":1,"amount":-35.0000,"netAmount":-33.2500,"profit":1.7500},{"groupDescription":"Closing Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":501.5000,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":1.7500}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-03_2018-01-03
     */
    public function testCashupSingleDay03Jan2018(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-03', '2018-01-03');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Opening Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":501.5000,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"Electricity-Eskom","itemCount":1,"amount":-300.0000,"netAmount":-300.0000,"profit":0.0000},{"groupDescription":"Recharges","itemDescription":"Telkom Mobile","itemCount":1,"amount":-149.0000,"netAmount":-140.0600,"profit":8.9400},{"groupDescription":"Deposits","itemDescription":"Credit","itemCount":1,"amount":500.0000,"netAmount":500.0000,"profit":0.0000},{"groupDescription":"Deposits","itemDescription":"Deposit Fee","itemCount":1,"amount":-3.6400,"netAmount":-3.6400,"profit":0.0000},{"groupDescription":"Closing Balance","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":557.8000,"profit":0.0000},{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":8.9400}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-30_2018-01-30
     */
    public function testCashupSingleDay30Jan2018(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-30', '2018-01-30');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":null}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-31_2018-01-31
     */
    public function testCashupSingleDayNoEntries(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTQ2MTI1LCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAzMjUyNSwiaWF0IjoxNTE4OTQ2MTI1fQ.hLzEEmpU8MKGcHnd_ATaDdgqEjlWKBpE8262h2SWbWQ');
        $response = $client->cashup('27813272161', '2018-01-31', '2018-01-31');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('ok', $response['status']);
        self::assertEquals(200, $response['http_code']);
        self::assertEquals('{"error":null,"responseCode":null,"cashupResponseItems":[{"groupDescription":"Total Profit","itemDescription":"","itemCount":0,"amount":0.0000,"netAmount":0.0000,"profit":null}]}', $response['body']);
    }

    /**
     * @vcr test_cashup_27813272161_2018-01-01_2018-01-31__invalid_token
     */
    public function testCashupInvalidToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->cashup('27813272161', '2018-01-01', '2018-01-31');

        self::assertInternalType('array', $response);
        self::assertCount(3, $response);
        self::assertEquals('error', $response['status']);
        self::assertEquals(401, $response['http_code']);
        self::assertInstanceOf('\StdClass', $response['body']);
        $expected = new \StdClass;
        $expected->responseDescription = 'Authorization denied. Token validation failed';
        $expected->accessToken = null;
        $expected->tokenType = null;
        $expected->expiresAt = null;
        $expected->scope = null;

        self::assertEquals($expected, $response['body']);
    }
}
