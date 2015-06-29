# PHP-TelegramLibrary
PHP Library for the new Telegram Bot API

* Event based programming for the new bot api (https://core.telegram.org/bots/api)
* Closures
* Composer Ready 
* Fully OOP
* All Methods and Types available
* Documented

use Tekook\TelegramLibrary;

$telegram = new TelegramLibrary\TelegramBotApi("<your token>");


$eventHandler = $telegram->getEventHandler();
$eventHandler->addHook(TelegramLibrary\Events::TEXT,
        function(\Tekook\TelegramLibrary\Types\Message $message) {
    if ($message->getText() == "A") {
        $message->reply("OK", ["reply_markup" => new TelegramLibrary\Markups\ReplyKeyboardHide()]);
    } else {
        $message->reply("Hello, " . $message->getFrom()->getFirstName() . " please answer A!",
                [
            "reply_markup" => new TelegramLibrary\Markups\ReplyKeyboardMarkup([
                ["A", "B"],
                ["C", "D"],
                ["E", "F"],
                    ])
        ]);
    }
});

$telegram->pushUpdate($r);
