# Telegram PHP SDK

PHP library for Telegram API, possible to send messages from bot to user.

## Installation

```
composer require teh9/telegram-php-sdk
```

## Usage

Create TelegramApiClient object using the following code:

```php 
$tg = new TelegramApiClient();
```

## API Requests

Sending messages for users from bot, should be provided <a href="https://telegram.me/getmyid_bot">**user chat id**.</a>

```php 
$tg = new TelegramApiClient();
$tg->messages()->send($access_token, [
    'chat_id' => 'USER_CHAT_ID',
    'text'    => 'test'
]);
```

## License

The MIT License (MIT). Please see <a href="https://github.com/teh9/telegram-php-sdk/blob/master/LICENSE">License File</a> for more information.

