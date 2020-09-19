<?php

declare(strict_types=1);
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * PLEASE NOTE: The interface is very fluid while the intial integration
 * is taking place.  It will be refactored in the near future.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2020 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient;

use GuzzleHttp\Client as HttpClient;
use Jacques\Smartcall\HttpClient\Traits\Dstv;
use Jacques\Smartcall\HttpClient\Traits\Easypay;
use Jacques\Smartcall\HttpClient\Traits\SmartLoad;
use Jacques\Smartcall\HttpClient\Traits\SmartRica;
use Jacques\Smartcall\HttpClient\Traits\Utilities;

class Client
{
    use Dstv;
    use Easypay;
    use SmartLoad;
    use SmartRica;
    use Utilities;

    /**
     * @const string Version number
     */
    const VERSION = '0.0.1';

    /**
     * @var HttpClient
     */
    protected $client;

    /**
     * Defaults to expecting that Apache Tomcat runs on port 8080 on localhost
     * (127.0.0.1).
     *
     * @var array
     */
    protected $options = [
        'scheme'   => 'https',
        'hostname' => 'localhost',
        'port'     => '8080',
        'token'    => null,
        'username' => null,
        'password' => null,
    ];

    /**
     * @param array $options
     */
    public function __construct($options = [])
    {
        /*
         * Allow on instantiation to overwrite the defaults
         */
        $this->options = array_merge(
            $this->options,
            $options
        );
        $config = [
            'base_uri' => sprintf(
                '%s://%s:%s/',
                $this->options['scheme'],
                $this->options['hostname'],
                $this->options['port']
            ),
            'verify'  => false,
            'headers' => [
                'User-Agent' => 'SmartcallRestfulAPIClient-PHP/'.self::VERSION.' '.\GuzzleHttp\default_user_agent(),
            ],
        ];
        $this->client = new HttpClient($config);
    }

    /**
     * Set the bearer token.
     *
     * @param string $token Bearer Token from Auth request
     *
     * @return void
     */
    public function setBearerToken(string $token): void
    {
        $this->options['token'] = $token;
    }

    /**
     * Set the password for basic authentication.
     *
     * @param string $password Password for use with basic authentication
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->options['password'] = $password;
    }

    /**
     * Set the username for basic authentication.
     *
     * @param string $username Username for use with basic authentication
     *
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->options['username'] = $username;
    }

    /**
     * Authenticate and get Bearer token from SmartCall.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function auth()
    {
        try {
            $response = $this->client->post(
                '/webservice/auth',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and invalidates all the user allocated tokens.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function authDelete()
    {
        try {
            $response = $this->client->delete(
                '/webservice/auth',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and invalidates all the user allocated tokens.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function authFlush()
    {
        try {
            $response = $this->client->delete(
                '/webservice/auth/token',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and gets the number of available session tokens.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function authToken()
    {
        try {
            $response = $this->client->get(
                '/webservice/auth/token',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Test SmartCall is responding.
     *
     * @throws \Exception
     *
     * @return array
     */
    public function ping()
    {
        try {
            $response = $this->client->get(
                '/webservice/test/ping'
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Parse the java exception that we receive from Smartcall's Tomcat's.
     *
     * @param \GuzzleHttp\Exception\ClientException $exception
     *
     * @return array
     */
    private function clientError(\GuzzleHttp\Exception\ClientException $exception): array
    {
        $body = (string) $exception->getResponse()->getBody();

        return [
            'status'    => 'error',
            'http_code' => $exception->getResponse()->getStatusCode(),
            'body'      => json_decode($body),
        ];
    }

    /**
     * Parse the java exception that we receive from Smartcall's Tomcat's.
     *
     * @param \GuzzleHttp\Exception\ServerException $exception
     *
     * @return array
     */
    private function parseError(\GuzzleHttp\Exception\ServerException $exception): array
    {
        $body = (string) $exception->getResponse()->getBody();
        preg_match('/<p><b>(JBWEB\d{6}): type<\/b> (JBWEB\d{6}): Exception report<\/p><p><b>(JBWEB\d{6}): message<\/b> <u>(.*[^<\/u>])<\/u><\/p><p><b>(JBWEB\d{6}): description<\/b> <u>(.+[^<\/u>])<\/u><\/p>/ims', $body, $matches);

        return [
            'status'    => 'error',
            'http_code' => $exception->getResponse()->getStatusCode(),
            'body'      => $matches['6'],
        ];
    }

    /**
     * Use basic authentication header content if bearer token  is not set.
     *
     * @return string
     */
    private function bearerOrBasic(): string
    {
        /**
         * Get the function calling this method.
         */
        $caller = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['function'];

        if (!($caller == 'auth')
        ) {
            return sprintf(
                'Bearer %s',
                $this->options['token']
            );
        }

        return sprintf(
            'Basic %s',
            base64_encode(
                sprintf(
                    '%s:%s',
                    $this->options['username'],
                    $this->options['password']
                )
            )
        );
    }
}
