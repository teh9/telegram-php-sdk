<?php

namespace Teh9\TelegramPhpSdk\Telegram\TransportClient;

interface TransportClient
{
    /**
     * Makes post request.
     *
     * @param string $url
     * @param array|null $payload
     *
     * @return bool|string
     * @throws TransportRequestException
     */
    public function post(string $url, ?array $payload = null);
}
