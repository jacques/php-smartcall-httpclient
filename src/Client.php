<?php
/**
 * SmartCall Restful API (v3) HTTP Client
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */

namespace Jacques\Smartcall\HttpClient;

class Client extends \GuzzleHttp\Client
{
    /**
     * @const string Version number
     */
    const VERSION = '0.0.1';

    /**
     * Defaults to expecting that Apache Tomcat runs on port 8080 on localhost
     * (127.0.0.1).
     *
     * @var array[]
     */
    protected $options = [
        'scheme'   => 'https',
        'hostname' => 'localhost',
        'port'     => '8080',
    ];

    /**
     * @param   $options array
     *
     * @return void
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
            'verify' => false,
            'headers' => [
                'User-Agent' => 'SmartcallRestfulAPIClient-PHP/'.self::VERSION.' '.\GuzzleHttp\default_user_agent(),
            ],
        ];
        parent::__construct($config);
    }

    /**
     * Authenticate and get Bearer token from SmartCall
     *
     * @param string $username
     * @param string $password
     *
     * @throws Exception
     *
     * @return array
     */
    public function auth($username, $password)
    {
        try {
            $response = $this->post(
                '/webservice/auth',
                [
                    'headers' => [
                        'Authorization' => sprintf(
                            'Basic %s',
                            base64_encode(
                                sprintf(
                                    '%s:%s',
                                    $username,
                                    $password
                                )
                            )
                        ),
                    ],
                ]
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Test SmartCall is responding.
     *
     * @throws Exception
     *
     * @return array
     */
    public function ping()
    {
        try {
            $response = $this->get(
                '/webservice/test/ping'
            );

            return [
                'status'    => 'ok',
                'http_code' => $response->getStatusCode(),
                'body'      => (string) $response->getBody(),
            ];
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }
}
