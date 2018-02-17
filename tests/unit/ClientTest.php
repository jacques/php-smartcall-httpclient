<?php
/**
 * SmartCall Restful API (v3) HTTP Client
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2018 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Unit;

use Jacques\Smartcall\HttpClient\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
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

    public function testConstructor()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
        ]);

        self::assertInstanceOf('Jacques\Smartcall\HttpClient\Client', $client);
        $expected = [
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'token' => null,
            'username' => null,
            'password' => null,
        ];
        self::assertAttributeEquals($expected, 'options', $client);

        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ]);

        self::assertInstanceOf('Jacques\Smartcall\HttpClient\Client', $client);
        $expected = [
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'token' => null,
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];
        self::assertAttributeEquals($expected, 'options', $client);
    }

    public function testSetBearerToken()
    {
        $client = new Client([
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ]);

        self::assertInstanceOf('Jacques\Smartcall\HttpClient\Client', $client);
        $expected = [
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'token' => null,
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];
        self::assertAttributeEquals($expected, 'options', $client);
        $client->setBearerToken('bearer-token-test');
        $expected = [
            'scheme' => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port' => '8101',
            'token' => 'bearer-token-test',
            'username' => 'joesoap',
            'password' => 'sw0rdf1sh',
        ];
        self::assertAttributeEquals($expected, 'options', $client);
    }
}
