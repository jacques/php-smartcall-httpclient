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

final class PingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @vcr test_ping
     */
    public function testPing(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->ping();

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"response":"Pong"}', $response['body']);
    }
}
