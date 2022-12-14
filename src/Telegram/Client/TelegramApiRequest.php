<?php

namespace Teh9\TelegramPhpSdk\Telegram\Client;

use Teh9\TelegramPhpSdk\Telegram\Exceptions\TelegramClientException;
use Teh9\TelegramPhpSdk\Telegram\TransportClient\Curl\CurlHttpClient;
use Teh9\TelegramPhpSdk\Telegram\TransportClient\TransportClientResponse;
use Teh9\TelegramPhpSdk\Telegram\TransportClient\TransportRequestException;

class TelegramApiRequest
{
    protected const CONNECTION_TIMEOUT = 10;

    /**
     * @var string
     */
    private string $host;

    /**
     * @var CurlHttpClient
     */
    private CurlHttpClient $http_client;

    /**
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host        = $host;
        $this->http_client = new CurlHttpClient(static::CONNECTION_TIMEOUT);
    }

    /**
     * @param string $method
     * @param string $access_token
     * @param array $params
     * @return array
     * @throws TelegramClientException
     */
    public function post (string $method, string $access_token, array $params = array()): array
    {
        $url = $this->host . $access_token . '/' . $method;

        try {
            $response = $this->http_client->post($url, $params);
        } catch (TransportRequestException $e) {
            throw new TelegramClientException($e);
        }

        return $this->parseResponse($response);
    }

    /**
     * @param TransportClientResponse $response
     * @return array
     */
    private function parseResponse(TransportClientResponse $response): array
    {
        return $this->decodeBody($response->getBody());
    }

    /**
     * @param string $body
     * @return array
     */
    protected function decodeBody(string $body): array
    {
        $decoded_body = json_decode($body, true);

        if (!is_array($decoded_body)) {
            $decoded_body = [];
        }

        return $decoded_body;
    }
}
