<?php

namespace Javaabu\Boli;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class Boli
{
    const DEFAULT_API_URL = 'https://api-business.egov.mv/WebApi/api';

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
     * @param string $username
     * @param string $password
     * @param string|null $url
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
        $this->api_url = rtrim($url ?: self::DEFAULT_API_URL, '/');

        $this->client = $this->initClient($client_options);
    }

    /**
     * Generate the access token for sending requests
     */
    protected function generateAccessToken(): string
    {
        return base64_encode($this->username.':'.$this->password);
    }

    /**
     * Initialize the guzzle client
     */
    protected function initClient(array $client_options): Client
    {
        $client_options = array_merge([
            'base_uri' => $this->api_url,
            'headers' => [
                'Authorization' => 'Basic ' . $this->generateAccessToken(),
                'Content-Type'  => 'application/json',
            ],
        ], $client_options);

        return new Client($client_options);
    }

    /**
     * Send a request an endpoint
     *
     * @param string $endpoint
     * @param array $params
     * @param string $method
     */
    protected function sendRequest(string $endpoint, $params = [], $method = 'GET'): ResponseInterface
    {
        $params_name = $method == 'GET' ? 'query' : 'form_params';

        $endpoint = '/'.ltrim($endpoint, '/');

        return $this->client->request($method, $endpoint, [
            $params_name => $params,
        ]);
    }

    /**
     * Get a json response
     *
     * @param string $endpoint
     * @param array $params
     * @return array
     */
    protected function getJson(string $endpoint, $params = []): ?array
    {
        try {
            return json_decode(
                $this->sendRequest($endpoint, $params)
                    ->getBody()
                    ->getContents(),
                true
            );
        } catch (ClientException $e) {
            if ($e->getCode() == 404) {
                return null;
            } else {
                throw $e;
            }
        }
    }

    /**
     * Get a single business entity
     *
     * @param string $registration_number
     * @return array
     */
    public function getBusinessEntity(string $registration_number): ?array
    {
        return $this->getJson('/BusinessEntities/GetBusinessEntity', ['businessEntityNumber' => $registration_number]);
    }

    /**
     * Get a single business name
     *
     * @param string $registration_number
     * @return array
     */
    public function getBusinessName(string $registration_number): ?array
    {
        $product = $this->getProduct($registration_number);

        if ($product && $product['productTypeId'] == 8) {
            return $product;
        }

        return null;
    }

    /**
     * Get a single product
     *
     * @param string $registration_number
     * @return array
     */
    public function getProduct(string $registration_number): ?array
    {
        return $this->getJson('/products/GetProduct', ['productNumber' => $registration_number]);
    }

    /**
     * Get a single import license
     *
     * @param string $license_number
     * @return array
     */
    public function getImportLicense(string $license_number): ?array
    {
        return $this->getJson('/products/GetImportLicense', ['productNumber' => $license_number]);
    }

}
