<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 21:19:01
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

use Tekook\TelegramLibrary\Events;

/**
 * Represents a message (update->message)
 * Contains any data
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Message extends Type implements IMessage
{
    /*
     * *********************************
     * Constants
     * *********************************
     */

    /**
     * Message is a user message
     */
    const SCOPE_USER_MESSAGE = 1;

    /**
     * Message is a groupchat message
     */
    const SCOPE_GROUP_MESSAGE = 2;

    /**
     * Normal Message
     */
    const TYPE_NORMAL = 1;

    /**
     * Message is a forwared message
     */
    const TYPE_FORWARD = 2;

    /**
     * Message is a reply to an message
     */
    const TYPE_REPLY = 3;

    /*
     * *********************************
     * Variables
     * *********************************
     */

    /**
     * The scpoe of Message received
     * @var int
     */
    protected $messageScope;

    /**
     * The Type of Message received
     * @var int
     */
    protected $messageType;

    /**
     * The Event of the message received
     * @var int
     */
    protected $messageEvent;

    /**
     * The User-Object the message came from
     * @var User
     */
    protected $from;

    /**
     * The chat the message came from
     * User or GroupChat
     * @var IChat
     */
    protected $chat;

    /**
     * Contains the original User which the message got forwared from (if forwarded)
     * @var User
     */
    protected $forwardFrom = null;

    /**
     * Contains the original timestamp of the message which got forwared (if forwarded)
     * @var int
     */
    protected $forwardDate = null;

    /**
     * AudioFile
     * @var Audio
     */
    protected $audio = null;

    /**
     * DocumentFile
     * @var Document
     */
    protected $document = null;

    /**
     * Array of the diffrent Photosizes (if message is a photo)
     * @var Array:PhotoSize
     */
    protected $photo = array();

    /**
     * StickerFile
     * @var Sticker
     */
    protected $sticker = null;

    /**
     * VideoFile
     * @var Video
     */
    protected $video = null;

    /**
     * ContactFile
     * @var Contact
     */
    protected $contact = null;

    /**
     * Location
     * @var Location
     */
    protected $location = null;

    /**
     * Contains the new User of the GroupChat
     * @var User
     */
    protected $newChatParticipant = null;

    /**
     * Contains the User who left the GroupChat
     * @var User
     */
    protected $leftChatParticipant = null;

    /**
     * Contains the new name of the GroupChat
     * @var String
     */
    protected $newChatTitle = null;

    /**
     * Contains the diffrenz PhotoSizes of the new GroupChat photo
     * @var Array:PhotoSize
     */
    protected $newChatPhoto = array();

    /**
     * If true, the GroupChat photo has been deleted
     * @var boolean
     */
    protected $deleteChatPhoto = false;

    /**
     * If true, the message contains a GroupChat being created
     * @var boolean
     */
    protected $groupChatCreated = false;

    /**
     * Contains the message object if the message is an reply
     * @var \Tekook\TelegramLibrary\Types\Message
     */
    protected $replyToMessage = null;

    /*
     * *********************************
     * Construct and retrieving
     * *********************************
     */

    public function __construct(\stdClass $data, \Tekook\TelegramLibrary\TelegramBotApi $api)
    {
        parent::__construct($data, $api);

        $this->messageEvent = \Tekook\TelegramLibrary\Events::TEXT;
        $this->messageType = self::TYPE_NORMAL;

        $this->retrieveData();
    }

    /**
     * Analyses the data and sets event corrensponding to the data
     */
    protected function retrieveData()
    {
        // FROM
        $this->receiveData("from", null, "User", true);

        // CHAT
        if (isset($this->data->chat->first_name)) {
            $this->chat = new User($this->data->chat, $this->api);
            $this->messageScope = self::SCOPE_USER_MESSAGE;
        } elseif (isset($this->data->chat->title)) {
            $this->chat = new GroupChat($this->data->chat, $this->api);
            $this->messageScope = self::SCOPE_GROUP_MESSAGE;
        } else {
            $this->throwMissingError("chat");
        }

        // FORWARD_FROM
        if (isset($this->data->forward_from)) {
            $this->forwardFrom = new User($this->data->forward_from, $this->api);
            $this->fordwardDate = $this->data->forward_date;
            $this->messageType = self::TYPE_FORWARD;
        }

        // Audio
        $this->receiveData("audio", null, "Audio");

        // Document
        $this->receiveData("document", null, "Document");

        // photo
        if (isset($this->data->photo)) {
            $this->messageEvent = Events::PHOTO;
            foreach ($this->data->photo as $photo) {
                $this->photo[] = new PhotoSize($photo);
            }
        }

        // Sticker
        $this->receiveData("sticker", null, "Sticker");

        // Video
        $this->receiveData("video", null, "Video");

        // Contact
        $this->receiveData("contact", null, "Contact");

        // Location
        $this->receiveData("location", null, "Location");

        // newChatParticipant
        $this->receiveData("new_chat_participant", "newChatParticipant", "User");

        // leftChatParticipant
        $this->receiveData("left_chat_participant", "leftChatParticipant", "User");

        // newChatTitle
        $this->receiveData("new_chat_title", "newChatTitle");

        // newChatPhoto
        if (isset($this->data->new_chat_photo)) {
            $this->messageEvent = Events::NEW_CHAT_PHOTO;
            foreach ($this->data->new_chat_photo as $photo) {
                $this->new_chat_photo[] = new PhotoSize($photo);
            }
        }

        // deleteChatPhoto
        $this->receiveData("delete_chat_photo", "deleteChatPhoto");

        // groupChatCreated
        $this->receiveData("group_chat_created", "groupChatCreated");

        // Reply Message
        $this->receiveData("reply_to_message", "replyToMessage", "Message");

        if (!is_null($this->replyToMessage)) {
            $this->messageType = self::TYPE_REPLY;
        }
    }

    /*
     * *********************************
     * Various Checks
     * *********************************
     */

    /**
     * Determinates if the message is received in a GroupChat
     * @return boolean
     */
    public function isGroupMessage()
    {
        return $this->messageScope === self::SCOPE_GROUP_MESSAGE;
    }

    /**
     * Determinates if the message is receiver from a User
     * @return type
     */
    public function isUserMessage()
    {
        return $this->messageScope === self::SCOPE_USER_MESSAGE;
    }

    /**
     * Determinates if the message is a normal message
     * @return boolean
     */
    public function isNormalMessage()
    {
        return $this->messageType === self::TYPE_NORMAL;
    }

    /**
     * Determinates if the message is a reply on another message
     * @return boolean
     */
    public function isReplyMessage()
    {
        return $this->messageType === self::TYPE_REPLY;
    }

    /**
     * Determinates if the message is a forwared message
     * @return boolean
     */
    public function isForwardMessage()
    {
        return $this->messageType === self::TYPE_FORWARD;
    }

    /**
     * Checks if the message is the given $event
     * @param int $event One of \Tekook\TelegramLibrary\Events Consts
     */
    public function isEvent($event)
    {
        return $this->messageEvent === $event;
    }

    /**
     * Checks if the message is a attached file
     * @return boolean
     */
    public function isFile()
    {
        return in_array($this->messageEvent,
                [
            Events::AUDIO,
            Events::DOCUMENT,
            Events::PHOTO,
            Events::STICKER,
            Events::VIDEO,
        ]);
    }

    /*
     * **************************************
     * Getters
     * **************************************
     */

    /**
     * Returns the Audio if message was an AudioFile
     * @return Audio
     */
    public function getAudio()
    {
        return $this->audio;
    }

    /**
     * The chat the message came from
     * User or GroupChat
     * @var IChat
     */
    public function getChat()
    {
        return $this->chat;
    }

    /**
     * Returns the Contact if message was a Contact
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * The timestamp of the message
     * @return int
     */
    public function getDate()
    {
        return $this->data->date;
    }

    /**
     * Returns the Document if message was an Document
     * @return Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Returns the Event ID of the message
     * @return int
     */
    public function getEvent()
    {
        return $this->messageEvent;
    }

    /**
     * Contains the original timestamp of the message which got forwared (if forwarded)
     * @return int
     */
    public function getForwardDate()
    {
        return $this->forwardDate;
    }

    /**
     * Contains the original User which the message got forwared from (if forwarded)
     * @return User
     */
    public function getForwardFrom()
    {
        return $this->forwardFrom;
    }

    /**
     * The User-Object the message came from
     * @return User
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Returns the id of the chat the message was received in
     * @return int
     */
    public function getFromChatId()
    {
        return $this->chat->getId();
    }

    /**
     * Returns the left User of the GroupChat
     * @return User
     */
    public function getLeftChatParticipan()
    {
        return $this->leftChatParticipant;
    }

    /**
     * Returns the send location
     * @return Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Gets the message_id of the message
     * @return int
     */
    public function getMessageId()
    {
        return $this->data->message_id;
    }

    /**
     * Returns the new User of the GroupChat
     * @return User
     */
    public function getNewChatParticipan()
    {
        return $this->newChatParticipant;
    }

    /**
     * Returns an array of PhotoSizes if a new GroupChat Photo has been set
     * @return array:PhotoSize
     */
    public function getNewChatPhoto()
    {
        return $this->newChatPhoto;
    }

    /**
     * Returns an array of PhotoSizes if the message was a photo
     * @return array:PhotoSizes
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Returns the StickerFile if message was a sticker
     * @return Sticker
     */
    public function getSticker()
    {
        return $this->sticker;
    }

    /**
     * Gets the text of the message
     * @return string
     */
    public function getText()
    {
        return $this->data->text;
    }

    /**
     * Returns the VideoFile if message was a video
     * @return Video
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Returns the IFile 
     * @return \Tekook\TelegramLibrary\Types\IFile
     */
    public function getFile()
    {
        switch ($this->messageEvent) {
            case Events::AUDIO:
                return $this->getAudio();
            case Events::VIDEO:
                return $this->getVideo();
            case Events::DOCUMENT:
                return $this->getDocument();
            case Events::STICKER:
                return $this->getSticker();
            case Events::PHOTO:
                return $this->getPhoto()[count($this->getPhoto()) - 1];
        }
        return null;
    }

    /*
     * *********************************
     * Event Assignment
     * *********************************
     */

    /**
     * Override the receiveData of Type to make the event assignment
     * @param string $key
     * @param string $iKey
     * @param string $class
     * @param boolean $mandatory
     */
    protected function receiveData($key, $iKey = null, $class = null, $mandatory = false)
    {
        if (parent::receiveData($key, $iKey, $class, $mandatory)) {
            $event = strtoupper($key);
            if (defined("\Tekook\TelegramLibrary\Events::" . $event)) {
                $this->messageEvent = constant("\Tekook\TelegramLibrary\Events::{$event}");
            }
        }
    }

    /*
     * *********************************
     * REPLY OPTIONS
     * *********************************
     */

    /**
     * Replies to the message with the given text
     * @param string $text The reply text
     * @param array $options Optional options
     * @return \stdClass
     */
    public function reply($text, array $options = array())
    {
        $myOptions = array_merge($options, [
            "reply_to_message_id" => $this->getMessageId()
        ]);
        return $this->api->sendMessage($this->getChat(), $text, $myOptions);
    }

    /**
     * Replies to the message with a given file
     * @param \Tekook\TelegramLibrary\Types\IFile $file The file to send
     * @param array $options Optional options
     * @return \stdClass
     */
    public function replyFile(\Tekook\TelegramLibrary\Types\IFile $file, array $options = array())
    {
        $myOptions = array_merge($options, [
            "reply_to_message_id" => $this->getMessageId()
        ]);
        return $this->api->sendFile($this->getChat(), $file, $myOptions);
    }

    /**
     * Replies to the message with a given location
     * @param \Tekook\TelegramLibrary\Types\ILocation $location The location to send
     * @param array $options Optional options
     * @return \stdClass
     */
    public function replyLocation(\Tekook\TelegramLibrary\Types\ILocation $location, array $options = array())
    {
        $myOptions = array_merge($options, [
            "reply_to_message_id" => $this->getMessageId()
        ]);
        return $this->api->sendLocation($this->getChat(), $location, $myOptions);
    }

    /**
     * Forwards the message to a given $target
     * @param \Tekook\TelegramLibrary\Types\IChat $target The chat to forward the message to
     * @return \stdClass
     */
    public function forward(\Tekook\TelegramLibrary\Types\IChat $target)
    {
        return $this->api->forwardMessage($target, $this);
    }

}
