<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2024 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Unit;

use Jacques\Smartcall\HttpClient\Client;
use ReflectionClass;

final class ClientTest extends \PHPUnit\Framework\TestCase
{
    public function testConstructor(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);

        self::assertInstanceOf(\Jacques\Smartcall\HttpClient\Client::class, $client);
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => null,
            'username' => null,
            'password' => null,
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertEquals($expected, $options->getValue($client));

        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ]);

        self::assertInstanceOf(\Jacques\Smartcall\HttpClient\Client::class, $client);
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => null,
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertEquals($expected, $options->getValue($client));
    }

    public function testSetBearerToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ]);

        self::assertInstanceOf(\Jacques\Smartcall\HttpClient\Client::class, $client);
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => null,
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertEquals($expected, $options->getValue($client));

        $client->setBearerToken('bearer-token-test');
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertSame($expected, $options->getValue($client));
    }

    public function testSetPassword(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => 'joesoap',
        ]);

        self::assertInstanceOf(\Jacques\Smartcall\HttpClient\Client::class, $client);
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => 'joesoap',
            'password' => null,
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertEquals($expected, $options->getValue($client));

        $client->setPassword('sw0rdf1sh');
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertSame($expected, $options->getValue($client));
    }

    public function testSetUsername(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'password' => 'sw0rdf1sh',
        ]);

        self::assertInstanceOf(\Jacques\Smartcall\HttpClient\Client::class, $client);
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => null,
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertEquals($expected, $options->getValue($client));
        $client->setUsername('joesoap');
        $expected = [
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
            'token'    => 'bearer-token-test',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];

        $reflection = new ReflectionClass($client);
        $options = $reflection->getProperty('options');
        $options->setAccessible(true);

        self::assertSame($expected, $options->getValue($client));
    }
}
