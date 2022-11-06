<?php

namespace Teh9\TelegramPhpSdk\Telegram\TransportClient;

class TransportClientResponse
{
    /**
     * @var string|null
     */
    private ?string $body;

    /**
     * @param string|null $body
     */
    public function __construct (?string $body)
    {
        $this->body = $body;
    }

    /**
     * @return string|null
     */
    public function getBody (): ?string
    {
        return $this->body;
    }
}
