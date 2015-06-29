<?php

/**
 * @author: Julian 'Digital' Tekook <julian@tekook.de>
 * @company: DJ-Digital.Net
 * @copyright: 2015
 * @created: 26.06.2015 18:10:40
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary;

/**
 * Central API class for managing the API
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class TelegramBotApi
{

    /**
     * API Url of Telegram
     */
    const API = "https://api.telegram.org/bot";

    /**
     * Curl-Session for Requests
     * @var resource
     */
    protected $curl = null;

    /**
     * The Prefix for all requests with the botToken
     * @var string
     */
    protected $apiPrefix = "";

    /**
     * EventHandler for this api
     * @var \Tekook\TelegramLibrary\EventHandler
     */
    protected $eventHandler = null;

    /**
     * Creates a new TelegramBotApi object to manage your Bot
     * @param string $botToken The token to auth your bot
     */
    public function __construct($botToken)
    {
        $this->curl = curl_init();
        $this->apiPrefix = TelegramBotApi::API . $botToken . "/";
        $this->eventHandler = new EventHandler($this);
    }

    /**
     * Calls a method of the bot-api with the given arguments
     * @param string $method Name of the Method
     * @param array $arguments Optional POST Arguments
     * @throws Exception
     * @return \stdClass
     */
    protected function call($method, array $arguments = null)
    {
        $curl_options = [
            CURLOPT_URL => $this->apiPrefix . $method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => null,
            CURLOPT_POSTFIELDS => null,
            CURLOPT_SSL_VERIFYPEER => 0,
        ];

        if (!is_null($arguments)) {
            $curl_options[CURLOPT_POST] = true;
            $curl_options[CURLOPT_POSTFIELDS] = $arguments;
        }

        curl_setopt_array($this->curl, $curl_options);
        $cont = curl_exec($this->curl);
        if (!$cont) {
            throw new Exceptions\TelegramException(curl_error($this->curl), curl_errno($this->curl));
        } else {
            $response = json_decode($cont, false);

            if (!$response->ok) {
                throw new Exceptions\TelegramException($response->description, $response->error_code);
            }

            return $response;
        }
    }

    /**
     * Returns the event handler of this api
     * @return \Tekook\TelegramLibrary\EventHandler
     */
    public function getEventHandler()
    {
        return $this->eventHandler;
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
     * @return \Tekook\TelegramLibrary\Types\User
     */
    public function getMe()
    {
        return $this->call("getMe");
    }

    /**
     * Central function to handle incoming Updates via WebHoook
     * Performs event handling and hook calling
     * @param string $input if not given, php://input will be used
     */
    public function pushUpdate($input = null)
    {
        if (is_null($input)) {
            $input = file_get_contents("php://input");
        }
        $json = json_decode($input, false);

        $update = new Types\Update($json, $this);

        $this->eventHandler->handle($update);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook.
     * Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update.
     * In case of an unsuccessful request, we will give up after a reasonable amount of attempts.
     * @param string $url
     * @return \stdClass
     */
    public function setWebhook($url)
    {
        return $this->call("setWebhook", ["url" => $url]);
    }

    /**
     * Sends a text message to the given Chat (Can be a User or a Groupchat)
     * @param \Tekook\TelegramLibrary\Types\IChat $chat
     * @param string $text
     * @param array $options Optional options
     * @return \stdClass
     */
    public function sendMessage(\Tekook\TelegramLibrary\Types\IChat $chat, $text, array $options = array())
    {
        $myOptions = array_merge($options, ["chat_id" => $chat->getId(), "text" => $text]);
        return $this->call("sendMessage", $myOptions);
    }

    /**
     * Sends a file to the given $chat
     * @param \Tekook\TelegramLibrary\Types\IChat $chat The recipient
     * @param \Tekook\TelegramLibrary\Types\IFile $file The file to send
     * @param array $options Optional options
     * @return \stdClass
     */
    public function sendFile(\Tekook\TelegramLibrary\Types\IChat $chat, \Tekook\TelegramLibrary\Types\IFile $file,
            array $options = array())
    {
        $myOptions = array_merge($options, ["chat_id" => $chat->getId(), $file->getFileType() => $file->getFileId()]);
        return $this->call("send" . ucfirst($file->getFileType()), $myOptions);
    }

    /**
     * Sends a location to the given $chat
     * @param \Tekook\TelegramLibrary\Types\IChat $chat The recipient
     * @param \Tekook\TelegramLibrary\Types\ILocation $location The location to send
     * @param array $options Optional options
     * @return \stdClass
     */
    public function sendLocation(\Tekook\TelegramLibrary\Types\IChat $chat,
            \Tekook\TelegramLibrary\Types\ILocation $location, array $options = array())
    {
        $myOptions = array_merge($options,
                [
            "chat_id" => $chat->getId(),
            "latitude" => $location->getLatitude(),
            "longitude" => $location->getLongitude()
        ]);
        return $this->call("sendLocation", $myOptions);
    }

    /**
     * Enumerates the profile photos of the given $user
     * @param \Tekook\TelegramLibrary\Types\IUser $user The user 
     * @param int $offset Optional offset
     * @param int $limit Optional limit
     * @return \Tekook\TelegramLibrary\Types\UserProfilePhotos
     */
    public function getUserProfilePhotos(\Tekook\TelegramLibrary\Types\IUser $user, $offset = 0, $limit = 100)
    {
        $response = $this->call("getUserProfilePhotos",
                ["user_id" => $user->getId(), "offset" => $offset, "limit" => $limit]);
        return new \Tekook\TelegramLibrary\Types\UserProfilePhotos($response->result);
    }

    /**
     * Sends a chat action to the given $chat indicating what the bot is doing right now
     * Should be one of \Tekook\TelegramLibrary\Actions constants
     * @param \Tekook\TelegramLibrary\Types\IChat $chat The recipient
     * @param string $action Constants of \Tekook\TelegramLibrary\Actions
     * @return \stdClass
     */
    public function sendChatAction(\Tekook\TelegramLibrary\Types\IChat $chat, $action)
    {
        return $this->call("sendChatAction", ["chat_id" => $chat->getId(), "action" => $action]);
    }

    /**
     * Forwards the given $message to a $target.
     * If $source is not given, the chat of $message will be used
     * @param \Tekook\TelegramLibrary\Types\IChat $target The recipient
     * @param \Tekook\TelegramLibrary\Types\IMessage $message The message to forward
     * @param \Tekook\TelegramLibrary\Types\IChat $source Optional source chat
     * @return \stdClass
     */
    public function forwardMessage(\Tekook\TelegramLibrary\Types\IChat $target,
            \Tekook\TelegramLibrary\Types\IMessage $message, \Tekook\TelegramLibrary\Types\IChat $source = null)
    {
        if ($source == null) {
            $source_id = $message->getFromChatId();
        } else {
            $source_id = $source->getId();
        }
        return $this->call("forwardMessage",
                        [
                    "chat_id" => $target->getId(),
                    "from_chat_id" => $source_id,
                    "message_id" => $message->getMessageId()
        ]);
    }

}
