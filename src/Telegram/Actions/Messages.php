<?php

namespace Teh9\TelegramPhpSdk\Telegram\Actions;

use Teh9\TelegramPhpSdk\Telegram\Client\TelegramApiRequest;
use Teh9\TelegramPhpSdk\Telegram\Exceptions\TelegramClientException;

class Messages
{
    /**
     * @var TelegramApiRequest
     */
    private TelegramApiRequest $request;

    /**
     * Messages constructor.
     *
     * @param TelegramApiRequest $request
     */
    public function __construct(TelegramApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @param string $access_token
     * @param array $params
     * @return bool|string
     * @throws TelegramClientException
     */
    public function send(string $access_token, array $params = [])
    {
        return $this->request->post('sendMessage', $access_token, $params);
    }
}
