<?php declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2023 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient\Tests\Integration;

use Jacques\Smartcall\HttpClient\Client;

final class NetworkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
    }

    /**
     * @vcr test_network_1
     */
    public function testNetworks(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4OTM3MDMyLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiMTY5LjEuMTYyLjE0OCIsImlzcyI6InNtYXJ0Y2FsbC5jby56YSIsImV4cCI6MTUxOTAyMzQzMiwiaWF0IjoxNTE4OTM3MDMyfQ.EMcP0J6DbT6Cu1vaCCVG0w-oD-WXyM_PlvycYWEkdT4');
        $response = $client->network(1);

        self::assertIsArray($response);
        self::assertCount(3, $response);
        self::assertSame('ok', $response['status']);
        self::assertSame(200, $response['http_code']);
        self::assertSame('{"id":1,"description":"Vodacom","productTypes":[{"id":1,"code":"A ","description":"Airtime","fixedAmount":false,"products":[{"id":62,"name":"Vodacom Airtime","description":"Vodacom Airtime","typeCode":"A ","minAmount":2.0000,"maxAmount":1000.0000,"discountPercentage":5.5000,"retailValue":99999.9900,"pinIndicator":false,"smsIndicator":false},{"id":62,"name":"Vodacom Airtime","description":"Vodacom Airtime","typeCode":"A ","minAmount":2.0000,"maxAmount":1000.0000,"discountPercentage":5.5000,"retailValue":99999.9900,"pinIndicator":false,"smsIndicator":true}]},{"id":2,"code":"S ","description":"SMS Bundle","fixedAmount":true,"products":[{"id":13,"name":"20 SMS-R10","description":"20 SMS-R10","typeCode":"S ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.5000,"retailValue":10.0000,"pinIndicator":false,"smsIndicator":false},{"id":13,"name":"20 SMS-R10","description":"20 SMS-R10","typeCode":"S ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.5000,"retailValue":10.0000,"pinIndicator":false,"smsIndicator":true},{"id":14,"name":"50 SMS-R25","description":"50 SMS-R25","typeCode":"S ","minAmount":25.0000,"maxAmount":25.0000,"discountPercentage":5.5000,"retailValue":25.0000,"pinIndicator":false,"smsIndicator":false},{"id":14,"name":"50 SMS-R25","description":"50 SMS-R25","typeCode":"S ","minAmount":25.0000,"maxAmount":25.0000,"discountPercentage":5.5000,"retailValue":25.0000,"pinIndicator":false,"smsIndicator":true},{"id":15,"name":"100 SMS-R33","description":"100 SMS-R33","typeCode":"S ","minAmount":33.0000,"maxAmount":33.0000,"discountPercentage":5.5000,"retailValue":33.0000,"pinIndicator":false,"smsIndicator":false},{"id":15,"name":"100 SMS-R33","description":"100 SMS-R33","typeCode":"S ","minAmount":33.0000,"maxAmount":33.0000,"discountPercentage":5.5000,"retailValue":33.0000,"pinIndicator":false,"smsIndicator":true},{"id":16,"name":"150 SMS-R49","description":"150 SMS-R49","typeCode":"S ","minAmount":49.0000,"maxAmount":49.0000,"discountPercentage":5.5000,"retailValue":49.0000,"pinIndicator":false,"smsIndicator":false},{"id":16,"name":"150 SMS-R49","description":"150 SMS-R49","typeCode":"S ","minAmount":49.0000,"maxAmount":49.0000,"discountPercentage":5.5000,"retailValue":49.0000,"pinIndicator":false,"smsIndicator":true},{"id":17,"name":"200 SMS-R45","description":"200 SMS-R45","typeCode":"S ","minAmount":45.0000,"maxAmount":45.0000,"discountPercentage":5.5000,"retailValue":45.0000,"pinIndicator":false,"smsIndicator":false},{"id":17,"name":"200 SMS-R45","description":"200 SMS-R45","typeCode":"S ","minAmount":45.0000,"maxAmount":45.0000,"discountPercentage":5.5000,"retailValue":45.0000,"pinIndicator":false,"smsIndicator":true},{"id":18,"name":"300 SMS-R67.50","description":"300 SMS-R67.50","typeCode":"S ","minAmount":67.5000,"maxAmount":67.5000,"discountPercentage":5.5000,"retailValue":67.5000,"pinIndicator":false,"smsIndicator":false},{"id":18,"name":"300 SMS-R67.50","description":"300 SMS-R67.50","typeCode":"S ","minAmount":67.5000,"maxAmount":67.5000,"discountPercentage":5.5000,"retailValue":67.5000,"pinIndicator":false,"smsIndicator":true},{"id":19,"name":"500 SMS-R112.50","description":"500 SMS-R112.50","typeCode":"S ","minAmount":112.5000,"maxAmount":112.5000,"discountPercentage":5.5000,"retailValue":112.5000,"pinIndicator":false,"smsIndicator":false},{"id":19,"name":"500 SMS-R112.50","description":"500 SMS-R112.50","typeCode":"S ","minAmount":112.5000,"maxAmount":112.5000,"discountPercentage":5.5000,"retailValue":112.5000,"pinIndicator":false,"smsIndicator":true},{"id":20,"name":"1000 SMS-R225","description":"1000 SMS-R225","typeCode":"S ","minAmount":225.0000,"maxAmount":225.0000,"discountPercentage":5.5000,"retailValue":225.0000,"pinIndicator":false,"smsIndicator":false},{"id":20,"name":"1000 SMS-R225","description":"1000 SMS-R225","typeCode":"S ","minAmount":225.0000,"maxAmount":225.0000,"discountPercentage":5.5000,"retailValue":225.0000,"pinIndicator":false,"smsIndicator":true},{"id":21,"name":"1500 SMS-R337.50","description":"1500 SMS-R337.50","typeCode":"S ","minAmount":337.5000,"maxAmount":337.5000,"discountPercentage":5.5000,"retailValue":337.5000,"pinIndicator":false,"smsIndicator":false},{"id":21,"name":"1500 SMS-R337.50","description":"1500 SMS-R337.50","typeCode":"S ","minAmount":337.5000,"maxAmount":337.5000,"discountPercentage":5.5000,"retailValue":337.5000,"pinIndicator":false,"smsIndicator":true},{"id":22,"name":"2000 SMS-R450","description":"2000 SMS-R450","typeCode":"S ","minAmount":450.0000,"maxAmount":450.0000,"discountPercentage":5.5000,"retailValue":450.0000,"pinIndicator":false,"smsIndicator":false},{"id":22,"name":"2000 SMS-R450","description":"2000 SMS-R450","typeCode":"S ","minAmount":450.0000,"maxAmount":450.0000,"discountPercentage":5.5000,"retailValue":450.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":15,"code":"X ","description":"30-day Data Bundle","fixedAmount":true,"products":[{"id":210,"name":"20MB-R10","description":"20MB-R10","typeCode":"X ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.5000,"retailValue":10.0000,"pinIndicator":false,"smsIndicator":false},{"id":210,"name":"20MB-R10","description":"20MB-R10","typeCode":"X ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.5000,"retailValue":10.0000,"pinIndicator":false,"smsIndicator":true},{"id":132,"name":"30MB-R12","description":"30MB-R12","typeCode":"X ","minAmount":12.0000,"maxAmount":12.0000,"discountPercentage":5.5000,"retailValue":12.0000,"pinIndicator":false,"smsIndicator":false},{"id":132,"name":"30MB-R12","description":"30MB-R12","typeCode":"X ","minAmount":12.0000,"maxAmount":12.0000,"discountPercentage":5.5000,"retailValue":12.0000,"pinIndicator":false,"smsIndicator":true},{"id":211,"name":"50MB-R15","description":"50MB-R15","typeCode":"X ","minAmount":15.0000,"maxAmount":15.0000,"discountPercentage":5.5000,"retailValue":15.0000,"pinIndicator":false,"smsIndicator":false},{"id":211,"name":"50MB-R15","description":"50MB-R15","typeCode":"X ","minAmount":15.0000,"maxAmount":15.0000,"discountPercentage":5.5000,"retailValue":15.0000,"pinIndicator":false,"smsIndicator":true},{"id":133,"name":"100MB-R29","description":"100MB-R29","typeCode":"X ","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.5000,"retailValue":29.0000,"pinIndicator":false,"smsIndicator":false},{"id":133,"name":"100MB-R29","description":"100MB-R29","typeCode":"X ","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.5000,"retailValue":29.0000,"pinIndicator":false,"smsIndicator":true},{"id":212,"name":"150MB-R39","description":"150MB-R39","typeCode":"X ","minAmount":39.0000,"maxAmount":39.0000,"discountPercentage":5.5000,"retailValue":39.0000,"pinIndicator":false,"smsIndicator":false},{"id":212,"name":"150MB-R39","description":"150MB-R39","typeCode":"X ","minAmount":39.0000,"maxAmount":39.0000,"discountPercentage":5.5000,"retailValue":39.0000,"pinIndicator":false,"smsIndicator":true},{"id":134,"name":"250MB-R63","description":"250MB-R63","typeCode":"X ","minAmount":63.0000,"maxAmount":63.0000,"discountPercentage":5.5000,"retailValue":63.0000,"pinIndicator":false,"smsIndicator":false},{"id":134,"name":"250MB-R63","description":"250MB-R63","typeCode":"X ","minAmount":63.0000,"maxAmount":63.0000,"discountPercentage":5.5000,"retailValue":63.0000,"pinIndicator":false,"smsIndicator":true},{"id":213,"name":"300MB-R69","description":"300MB-R69","typeCode":"X ","minAmount":69.0000,"maxAmount":69.0000,"discountPercentage":5.5000,"retailValue":69.0000,"pinIndicator":false,"smsIndicator":false},{"id":213,"name":"300MB-R69","description":"300MB-R69","typeCode":"X ","minAmount":69.0000,"maxAmount":69.0000,"discountPercentage":5.5000,"retailValue":69.0000,"pinIndicator":false,"smsIndicator":true},{"id":135,"name":"500MB-R99","description":"500MB-R99","typeCode":"X ","minAmount":99.0000,"maxAmount":99.0000,"discountPercentage":5.5000,"retailValue":99.0000,"pinIndicator":false,"smsIndicator":false},{"id":135,"name":"500MB-R99","description":"500MB-R99","typeCode":"X ","minAmount":99.0000,"maxAmount":99.0000,"discountPercentage":5.5000,"retailValue":99.0000,"pinIndicator":false,"smsIndicator":true},{"id":136,"name":"1GB-R149","description":"1GB-R149","typeCode":"X ","minAmount":149.0000,"maxAmount":149.0000,"discountPercentage":5.5000,"retailValue":149.0000,"pinIndicator":false,"smsIndicator":false},{"id":136,"name":"1GB-R149","description":"1GB-R149","typeCode":"X ","minAmount":149.0000,"maxAmount":149.0000,"discountPercentage":5.5000,"retailValue":149.0000,"pinIndicator":false,"smsIndicator":true},{"id":137,"name":"2GB-R249","description":"2GB-R249","typeCode":"X ","minAmount":249.0000,"maxAmount":249.0000,"discountPercentage":5.5000,"retailValue":249.0000,"pinIndicator":false,"smsIndicator":false},{"id":137,"name":"2GB-R249","description":"2GB-R249","typeCode":"X ","minAmount":249.0000,"maxAmount":249.0000,"discountPercentage":5.5000,"retailValue":249.0000,"pinIndicator":false,"smsIndicator":true},{"id":138,"name":"3GB-R299","description":"3GB-R299","typeCode":"X ","minAmount":299.0000,"maxAmount":299.0000,"discountPercentage":5.5000,"retailValue":299.0000,"pinIndicator":false,"smsIndicator":false},{"id":138,"name":"3GB-R299","description":"3GB-R299","typeCode":"X ","minAmount":299.0000,"maxAmount":299.0000,"discountPercentage":5.5000,"retailValue":299.0000,"pinIndicator":false,"smsIndicator":true},{"id":139,"name":"5GB-R399","description":"5GB-R399","typeCode":"X ","minAmount":399.0000,"maxAmount":399.0000,"discountPercentage":5.5000,"retailValue":399.0000,"pinIndicator":false,"smsIndicator":false},{"id":139,"name":"5GB-R399","description":"5GB-R399","typeCode":"X ","minAmount":399.0000,"maxAmount":399.0000,"discountPercentage":5.5000,"retailValue":399.0000,"pinIndicator":false,"smsIndicator":true},{"id":141,"name":"10GB-R599","description":"10GB-R599","typeCode":"X ","minAmount":599.0000,"maxAmount":599.0000,"discountPercentage":5.5000,"retailValue":599.0000,"pinIndicator":false,"smsIndicator":false},{"id":141,"name":"10GB-R599","description":"10GB-R599","typeCode":"X ","minAmount":599.0000,"maxAmount":599.0000,"discountPercentage":5.5000,"retailValue":599.0000,"pinIndicator":false,"smsIndicator":true},{"id":140,"name":"20GB-R999","description":"20GB-R999","typeCode":"X ","minAmount":999.0000,"maxAmount":999.0000,"discountPercentage":5.5000,"retailValue":999.0000,"pinIndicator":false,"smsIndicator":false},{"id":140,"name":"20GB-R999","description":"20GB-R999","typeCode":"X ","minAmount":999.0000,"maxAmount":999.0000,"discountPercentage":5.5000,"retailValue":999.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":25,"code":"SD","description":"Same Day Data","fixedAmount":true,"products":[{"id":221,"name":"20MB-R5","description":"20MB-R5","typeCode":"SD","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.5000,"retailValue":5.0000,"pinIndicator":false,"smsIndicator":false},{"id":221,"name":"20MB-R5","description":"20MB-R5","typeCode":"SD","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.5000,"retailValue":5.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":21,"code":"P3","description":"3mth Pay-once Data","fixedAmount":true,"products":[{"id":203,"name":"50MB pm-R29","description":"50MB pm-R29","typeCode":"P3","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.5000,"retailValue":29.0000,"pinIndicator":false,"smsIndicator":false},{"id":203,"name":"50MB pm-R29","description":"50MB pm-R29","typeCode":"P3","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.5000,"retailValue":29.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":20,"code":"P6","description":"6mth Pay-once Data","fixedAmount":true,"products":[{"id":204,"name":"100MB pm-R119","description":"100MB pm-R119","typeCode":"P6","minAmount":119.0000,"maxAmount":119.0000,"discountPercentage":5.5000,"retailValue":119.0000,"pinIndicator":false,"smsIndicator":false},{"id":204,"name":"100MB pm-R119","description":"100MB pm-R119","typeCode":"P6","minAmount":119.0000,"maxAmount":119.0000,"discountPercentage":5.5000,"retailValue":119.0000,"pinIndicator":false,"smsIndicator":true},{"id":205,"name":"250MB pm-R219","description":"250MB pm-R219","typeCode":"P6","minAmount":219.0000,"maxAmount":219.0000,"discountPercentage":5.5000,"retailValue":219.0000,"pinIndicator":false,"smsIndicator":false},{"id":205,"name":"250MB pm-R219","description":"250MB pm-R219","typeCode":"P6","minAmount":219.0000,"maxAmount":219.0000,"discountPercentage":5.5000,"retailValue":219.0000,"pinIndicator":false,"smsIndicator":true},{"id":206,"name":"500MB pm-R339","description":"500MB pm-R339","typeCode":"P6","minAmount":339.0000,"maxAmount":339.0000,"discountPercentage":5.5000,"retailValue":339.0000,"pinIndicator":false,"smsIndicator":false},{"id":206,"name":"500MB pm-R339","description":"500MB pm-R339","typeCode":"P6","minAmount":339.0000,"maxAmount":339.0000,"discountPercentage":5.5000,"retailValue":339.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":14,"code":"P ","description":"12mth Pay-once Data","fixedAmount":true,"products":[{"id":113,"name":"1GB pm-R899","description":"1GB pm-R899","typeCode":"P ","minAmount":899.0000,"maxAmount":899.0000,"discountPercentage":5.5000,"retailValue":899.0000,"pinIndicator":false,"smsIndicator":false},{"id":113,"name":"1GB pm-R899","description":"1GB pm-R899","typeCode":"P ","minAmount":899.0000,"maxAmount":899.0000,"discountPercentage":5.5000,"retailValue":899.0000,"pinIndicator":false,"smsIndicator":true},{"id":114,"name":"2GB pm-R1399","description":"2GB pm-R1399","typeCode":"P ","minAmount":1399.0000,"maxAmount":1399.0000,"discountPercentage":5.5000,"retailValue":1399.0000,"pinIndicator":false,"smsIndicator":false},{"id":114,"name":"2GB pm-R1399","description":"2GB pm-R1399","typeCode":"P ","minAmount":1399.0000,"maxAmount":1399.0000,"discountPercentage":5.5000,"retailValue":1399.0000,"pinIndicator":false,"smsIndicator":true},{"id":207,"name":"5GB pm-R3499","description":"5GB pm-R3499","typeCode":"P ","minAmount":3499.0000,"maxAmount":3499.0000,"discountPercentage":5.5000,"retailValue":3499.0000,"pinIndicator":false,"smsIndicator":false},{"id":207,"name":"5GB pm-R3499","description":"5GB pm-R3499","typeCode":"P ","minAmount":3499.0000,"maxAmount":3499.0000,"discountPercentage":5.5000,"retailValue":3499.0000,"pinIndicator":false,"smsIndicator":true},{"id":208,"name":"10GB pm-R5999","description":"10GB pm-R5999","typeCode":"P ","minAmount":5999.0000,"maxAmount":5999.0000,"discountPercentage":5.5000,"retailValue":5999.0000,"pinIndicator":false,"smsIndicator":false},{"id":208,"name":"10GB pm-R5999","description":"10GB pm-R5999","typeCode":"P ","minAmount":5999.0000,"maxAmount":5999.0000,"discountPercentage":5.5000,"retailValue":5999.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":8,"code":"R ","description":"Blackberry Bundle","fixedAmount":true,"products":[{"id":87,"name":"30 days-R59","description":"30 days-R59","typeCode":"R ","minAmount":59.0000,"maxAmount":59.0000,"discountPercentage":5.5000,"retailValue":59.0000,"pinIndicator":false,"smsIndicator":false},{"id":87,"name":"30 days-R59","description":"30 days-R59","typeCode":"R ","minAmount":59.0000,"maxAmount":59.0000,"discountPercentage":5.5000,"retailValue":59.0000,"pinIndicator":false,"smsIndicator":true},{"id":88,"name":"90 days-R177","description":"90 days-R177","typeCode":"R ","minAmount":177.0000,"maxAmount":177.0000,"discountPercentage":5.5000,"retailValue":177.0000,"pinIndicator":false,"smsIndicator":false},{"id":88,"name":"90 days-R177","description":"90 days-R177","typeCode":"R ","minAmount":177.0000,"maxAmount":177.0000,"discountPercentage":5.5000,"retailValue":177.0000,"pinIndicator":false,"smsIndicator":true},{"id":89,"name":"180 days-R354","description":"180 days-R354","typeCode":"R ","minAmount":354.0000,"maxAmount":354.0000,"discountPercentage":5.5000,"retailValue":354.0000,"pinIndicator":false,"smsIndicator":false},{"id":89,"name":"180 days-R354","description":"180 days-R354","typeCode":"R ","minAmount":354.0000,"maxAmount":354.0000,"discountPercentage":5.5000,"retailValue":354.0000,"pinIndicator":false,"smsIndicator":true},{"id":209,"name":"360 days-R708","description":"360 days-R708","typeCode":"R ","minAmount":708.0000,"maxAmount":708.0000,"discountPercentage":5.5000,"retailValue":708.0000,"pinIndicator":false,"smsIndicator":false},{"id":209,"name":"360 days-R708","description":"360 days-R708","typeCode":"R ","minAmount":708.0000,"maxAmount":708.0000,"discountPercentage":5.5000,"retailValue":708.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":16,"code":"WV","description":"Power Bundle Voucher","fixedAmount":true,"products":[{"id":143,"name":"R2 10 min call after recharge","description":"R2 10 min call after recharge","typeCode":"WV","minAmount":2.0000,"maxAmount":2.0000,"discountPercentage":5.3000,"retailValue":2.0000,"pinIndicator":true,"smsIndicator":false},{"id":143,"name":"R2 10 min call after recharge","description":"R2 10 min call after recharge","typeCode":"WV","minAmount":2.0000,"maxAmount":2.0000,"discountPercentage":5.3000,"retailValue":2.0000,"pinIndicator":true,"smsIndicator":true},{"id":144,"name":"R5 60 min call after recharge","description":"R5 60 min call after recharge","typeCode":"WV","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.3000,"retailValue":5.0000,"pinIndicator":true,"smsIndicator":false},{"id":144,"name":"R5 60 min call after recharge","description":"R5 60 min call after recharge","typeCode":"WV","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.3000,"retailValue":5.0000,"pinIndicator":true,"smsIndicator":true},{"id":145,"name":"R4 50MB 60 min after recharge","description":"R4 50MB 60 min after recharge","typeCode":"WV","minAmount":4.0000,"maxAmount":4.0000,"discountPercentage":5.3000,"retailValue":4.0000,"pinIndicator":true,"smsIndicator":false},{"id":145,"name":"R4 50MB 60 min after recharge","description":"R4 50MB 60 min after recharge","typeCode":"WV","minAmount":4.0000,"maxAmount":4.0000,"discountPercentage":5.3000,"retailValue":4.0000,"pinIndicator":true,"smsIndicator":true}]},{"id":13,"code":"V ","description":"Airtime Voucher","fixedAmount":true,"products":[{"id":65,"name":"Vodacom R2 voucher","description":"Vodacom R2 voucher","typeCode":"V ","minAmount":2.0000,"maxAmount":2.0000,"discountPercentage":5.3000,"retailValue":2.0000,"pinIndicator":true,"smsIndicator":false},{"id":65,"name":"Vodacom R2 voucher","description":"Vodacom R2 voucher","typeCode":"V ","minAmount":2.0000,"maxAmount":2.0000,"discountPercentage":5.3000,"retailValue":2.0000,"pinIndicator":true,"smsIndicator":true},{"id":66,"name":"Vodacom R5 voucher","description":"Vodacom R5 voucher","typeCode":"V ","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.3000,"retailValue":5.0000,"pinIndicator":true,"smsIndicator":false},{"id":66,"name":"Vodacom R5 voucher","description":"Vodacom R5 voucher","typeCode":"V ","minAmount":5.0000,"maxAmount":5.0000,"discountPercentage":5.3000,"retailValue":5.0000,"pinIndicator":true,"smsIndicator":true},{"id":67,"name":"Vodacom R10 voucher","description":"Vodacom R10 voucher","typeCode":"V ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.3000,"retailValue":10.0000,"pinIndicator":true,"smsIndicator":false},{"id":67,"name":"Vodacom R10 voucher","description":"Vodacom R10 voucher","typeCode":"V ","minAmount":10.0000,"maxAmount":10.0000,"discountPercentage":5.3000,"retailValue":10.0000,"pinIndicator":true,"smsIndicator":true},{"id":68,"name":"Vodacom R12 voucher","description":"Vodacom R12 voucher","typeCode":"V ","minAmount":12.0000,"maxAmount":12.0000,"discountPercentage":5.3000,"retailValue":12.0000,"pinIndicator":true,"smsIndicator":false},{"id":68,"name":"Vodacom R12 voucher","description":"Vodacom R12 voucher","typeCode":"V ","minAmount":12.0000,"maxAmount":12.0000,"discountPercentage":5.3000,"retailValue":12.0000,"pinIndicator":true,"smsIndicator":true},{"id":69,"name":"Vodacom R29 voucher","description":"Vodacom R29 voucher","typeCode":"V ","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.3000,"retailValue":29.0000,"pinIndicator":true,"smsIndicator":false},{"id":69,"name":"Vodacom R29 voucher","description":"Vodacom R29 voucher","typeCode":"V ","minAmount":29.0000,"maxAmount":29.0000,"discountPercentage":5.3000,"retailValue":29.0000,"pinIndicator":true,"smsIndicator":true},{"id":71,"name":"Vodacom R55 voucher","description":"Vodacom R55 voucher","typeCode":"V ","minAmount":55.0000,"maxAmount":55.0000,"discountPercentage":5.3000,"retailValue":55.0000,"pinIndicator":true,"smsIndicator":false},{"id":71,"name":"Vodacom R55 voucher","description":"Vodacom R55 voucher","typeCode":"V ","minAmount":55.0000,"maxAmount":55.0000,"discountPercentage":5.3000,"retailValue":55.0000,"pinIndicator":true,"smsIndicator":true},{"id":72,"name":"Vodacom R110 voucher","description":"Vodacom R110 voucher","typeCode":"V ","minAmount":110.0000,"maxAmount":110.0000,"discountPercentage":5.3000,"retailValue":110.0000,"pinIndicator":true,"smsIndicator":false},{"id":72,"name":"Vodacom R110 voucher","description":"Vodacom R110 voucher","typeCode":"V ","minAmount":110.0000,"maxAmount":110.0000,"discountPercentage":5.3000,"retailValue":110.0000,"pinIndicator":true,"smsIndicator":true},{"id":73,"name":"Vodacom R275 voucher","description":"Vodacom R275 voucher","typeCode":"V ","minAmount":275.0000,"maxAmount":275.0000,"discountPercentage":5.3000,"retailValue":275.0000,"pinIndicator":true,"smsIndicator":false},{"id":73,"name":"Vodacom R275 voucher","description":"Vodacom R275 voucher","typeCode":"V ","minAmount":275.0000,"maxAmount":275.0000,"discountPercentage":5.3000,"retailValue":275.0000,"pinIndicator":true,"smsIndicator":true},{"id":74,"name":"Vodacom R1100 voucher","description":"Vodacom R1100 voucher","typeCode":"V ","minAmount":1100.0000,"maxAmount":1100.0000,"discountPercentage":5.3000,"retailValue":1100.0000,"pinIndicator":true,"smsIndicator":false},{"id":74,"name":"Vodacom R1100 voucher","description":"Vodacom R1100 voucher","typeCode":"V ","minAmount":1100.0000,"maxAmount":1100.0000,"discountPercentage":5.3000,"retailValue":1100.0000,"pinIndicator":true,"smsIndicator":true}]},{"id":4,"code":null,"description":"Big Bonus Recharge","fixedAmount":true,"products":[{"id":142,"name":"Big Bonus-R699","description":"Big Bonus-R699","typeCode":null,"minAmount":699.0000,"maxAmount":699.0000,"discountPercentage":6.5000,"retailValue":699.0000,"pinIndicator":false,"smsIndicator":false},{"id":142,"name":"Big Bonus-R699","description":"Big Bonus-R699","typeCode":null,"minAmount":699.0000,"maxAmount":699.0000,"discountPercentage":6.5000,"retailValue":699.0000,"pinIndicator":false,"smsIndicator":true}]},{"id":22,"code":"W ","description":"Power Bundle","fixedAmount":true,"products":[]}]}', $response['body']);
    }

    /**
     * @vcr test_network_1__invalid_token
     */
    public function testNetworkInvalidToken(): void
    {
        $client = new Client([
            'scheme'   => 'https',
            'hostname' => 'www.smartcallesb.co.za',
            'port'     => '8101',
        ]);
        $response = $client->setBearerToken('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJTbWFydGNhbGwgUkVTVGZ1bCBXZWJzZXJ2aWNlIiwibmJmIjoxNTE4ODcyMzEzLCJjbGllbnRVc2VybmFtZSI6InRhcCIsImNsaWVudElQIjoiNDEuNzkuNzcuMjMiLCJpc3MiOiJzbWFydGNhbGwuY28uemEiLCJleHAiOjE1MTg5NTg3MTMsImlhdCI6MTUxODg3MjMxM30.Gzvlzdzu-EEIy-swibi-K6yRBu-IlBoNHXymxOYquwA');
        $response = $client->network(1);

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
