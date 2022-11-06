<?php

namespace Teh9\TelegramPhpSdk\Telegram\TransportClient\Curl;

use Teh9\TelegramPhpSdk\Telegram\TransportClient\TransportClient;
use Teh9\TelegramPhpSdk\Telegram\TransportClient\TransportClientResponse;
use Teh9\TelegramPhpSdk\Telegram\TransportClient\TransportRequestException;

class CurlHttpClient implements TransportClient
{
    /**
     * @var array
     */
    protected array $initial_opts;

    /**
     * @param int $connection_timeout
     */
    public function __construct (int $connection_timeout)
    {
        $this->initial_opts = array(
            CURLOPT_HEADER         => true,
            CURLOPT_CONNECTTIMEOUT => $connection_timeout,
            CURLOPT_RETURNTRANSFER => true,
        );
    }

    /**
     * @param string $url
     * @param array|null $payload
     * @return TransportClientResponse
     * @throws TransportRequestException
     */
    public function post (string $url, ?array $payload = null): TransportClientResponse
    {
        return $this->sendRequest($url, array(
            CURLOPT_POST       => 1,
            CURLOPT_POSTFIELDS => $payload
        ));
    }

    /**
     * @param string $url
     * @param array $opts
     * @return TransportClientResponse
     * @throws TransportRequestException
     */
    public function sendRequest (string $url, array $opts): TransportClientResponse
    {
        $curl = curl_init($url);

        curl_setopt_array($curl, $this->initial_opts + $opts);

        $response = curl_exec($curl);

        $curl_error_code = curl_errno($curl);
        $curl_error = curl_error($curl);

        curl_close($curl);

        if ($curl_error || $curl_error_code) {
            $error_msg = "Failed curl request. Curl error {$curl_error_code}";
            if ($curl_error) {
                $error_msg .= ": {$curl_error}";
            }

            $error_msg .= '.';

            throw new TransportRequestException($error_msg);
        }

        return $this->parseRawResponse($response);
    }

    /**
     * @param string $response
     * @return TransportClientResponse
     */
    protected function parseRawResponse(string $response): TransportClientResponse
    {
        [$body] = $this->extractResponseHeadersAndBody($response);
        return new TransportClientResponse($body);
    }

    /**
     * @param string $response
     * @return array
     */
    protected function extractResponseHeadersAndBody(string $response): array
    {
        $parts = explode("\r\n\r\n", $response);
        $raw_body = array_pop($parts);

        return [trim($raw_body)];
    }

}
