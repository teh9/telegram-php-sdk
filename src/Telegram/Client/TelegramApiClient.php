<?php

namespace Teh9\TelegramPhpSdk\Telegram\Client;

use Teh9\TelegramPhpSdk\Telegram\Actions\Messages;

class TelegramApiClient
{
    protected const API_HOST = 'https://api.telegram.org/bot';

    /**
     * @var TelegramApiRequest
     */
    private TelegramApiRequest $request;

    public function __construct()
    {
        $this->request = new TelegramApiRequest(self::API_HOST);
    }

    /**
     * @return Messages
     */
    public function messages(): Messages
    {
        return new Messages($this->request);
    }

}
