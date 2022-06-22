<?php

namespace Javaabu\Boli;

class Boli
{
    const DEFAULT_API_URL = 'https://api-business.egov.mv/WebApi/api/';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    protected $api_url;

    /**
     * Constructor
     *
     * @param string $api_key
     * @param string $app_id
     * @param string $mode
     * @param array $client_options
     */
    public function __construct(
        string $username,
        string $password,
        ?string $url = null,
        array $client_options = []
    )
    {
        $this->username = $username;
        $this->password = $password;
        $this->api_url = $url ?: self::DEFAULT_API_URL;
    }



}
