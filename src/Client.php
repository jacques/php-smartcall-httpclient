<?php
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * PLEASE NOTE: The interface is very fluid while the intial integration
 * is taking place.  It will be refactored in the near future.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017-2018 Jacques Marneweck.  All rights strictly reserved.
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
        parent::__construct($config);
    }

    /**
     * Set the bearer token.
     *
     * @param string $token Bearer Token from Auth request
     */
    public function setBearerToken($token)
    {
        $this->options['token'] = $token;
    }

    /**
     * Set the password for basic authentication.
     *
     * @param string $password Password for use with basic authentication
     */
    public function setPassword($password)
    {
        $this->options['password'] = $password;
    }

    /**
     * Set the username for basic authentication.
     *
     * @param string $username Username for use with basic authentication
     */
    public function setUsername($username)
    {
        $this->options['username'] = $username;
    }

    /**
     * Authenticate and get Bearer token from SmartCall.
     *
     * @throws Exception
     *
     * @return array
     */
    public function auth()
    {
        try {
            $response = $this->post(
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
     * @throws Exception
     *
     * @return array
     */
    public function authDelete()
    {
        try {
            $response = $this->delete(
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
     * @throws Exception
     *
     * @return array
     */
    public function authFlush()
    {
        try {
            $response = $this->delete(
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
     * @throws Exception
     *
     * @return array
     */
    public function authToken()
    {
        try {
            $response = $this->get(
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
     * Authenticate and request period based cashup reports.
     *
     * @param string $dealerMsisdn
     * @param string $start
     * @param string $end
     *
     * @throws Exception
     *
     * @return array
     */
    public function cashup($dealerMsisdn, $start, $end)
    {
        try {
            $response = $this->post(
                '/webservice/smartload/cashup',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json'    => [
                        'smartloadId' => $dealerMsisdn,
                        'startDate'   => $start,
                        'endDate'     => $end,
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
     * Authenticate and retrieves the dealer balance in Rands.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function balance($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/balance/%s',
                    $dealerMsisdn
                ),
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
     * Authenticate and request current day cashup report.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function cashupToday($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/cashup/%s',
                    $dealerMsisdn
                ),
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
     * Authenticate and request to transfer funds from one Smartload account to another.
     *
     * @param string $fromDealerMsisdn
     * @param string $toDealerMsisdn
     * @param string $amount
     * @param string $sendSms
     *
     * @throws Exception
     *
     * @return array
     */
    public function fundstransfer($fromDealerMsisdn, $toDealerMsisdn, $amount, $sendSms)
    {
        try {
            $response = $this->post(
                '/webservice/smartload/fundstransfer',
                [
                    'headers' => [
                        'Authorization' => $this->bearerOrBasic(),
                    ],
                    'json' => [
                        'sourceSmartloadId'    => $fromDealerMsisdn,
                        'recipientSmartloadId' => $toDealerMsisdn,
                        'amount'               => $amount,
                        'sendSms'              => $sendSms,
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
     * Authenticate and retrieves a list of all available networks.
     *
     * @throws Exception
     *
     * @return array
     */
    public function network($id)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/networks/%d',
                    $id
                ),
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
     * Authenticate and retrieves a list of all available networks.
     *
     * @throws Exception
     *
     * @return array
     */
    public function networks()
    {
        try {
            $response = $this->get(
                '/webservice/smartload/networks',
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
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return $this->clientError($e);
        } catch (\GuzzleHttp\Exception\ServerException $e) {
            return $this->parseError($e);
        }
    }

    /**
     * Authenticate and retrieves a list of all available networks.
     *
     * @throws Exception
     *
     * @return array
     */
    public function products($id)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/products/%d',
                    $id
                ),
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
     * Authenticate and checks if the provided ID (MSISDN) is registered with Smartload.
     *
     * @param string $dealerMsisdn
     *
     * @throws Exception
     *
     * @return array
     */
    public function registered($dealerMsisdn)
    {
        try {
            $response = $this->get(
                sprintf(
                    '/webservice/smartload/registered/%s',
                    $dealerMsisdn
                ),
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
     * Parse the java exception that we receive from Smartcall's Tomcat's.
     *
     * @param \GuzzleHttp\Exception\ClientException $exception
     *
     * @return array
     */
    private function clientError(\GuzzleHttp\Exception\ClientException $exception)
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
    private function parseError(\GuzzleHttp\Exception\ServerException $exception)
    {
        $body = (string) $exception->getResponse()->getBody();
        preg_match('!<p><b>type</b> Exception report</p><p><b>message</b> <u>(.*[^</u>])</u></p><p><b>description</b>!', $body, $matches);

        return [
            'status'    => 'error',
            'http_code' => $exception->getResponse()->getStatusCode(),
            'body'      => $matches['1'],
        ];
    }

    /**
     * Use basic authentication header content if bearer token  is not set.
     *
     * @return string
     */
    private function bearerOrBasic()
    {
        /**
         * Get the function calling this method.
         */
        $caller = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 2)[1]['function'];

        if (
            !in_array(
                $caller,
                [
                    'auth',
                ]
            )
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
