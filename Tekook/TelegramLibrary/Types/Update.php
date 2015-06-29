<?php

/**
 * @author: Julian 'Digital' Tekook <julian@tekook.de>
 * @company: DJ-Digital.Net
 * @copyright: 2015
 * @created: 29.06.2015 11:12:40
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a update
 *
 * @author Julian 'Digital' Tekook <julian@tekook.de>
 */
class Update extends Type
{

    /**
     * The id of the update
     * @var int
     */
    protected $id;

    /**
     * The message the update contains
     * @var \Tekook\TelegramLibrary\Types\Message
     */
    protected $message;

    public function __construct(\stdClass $data, \Tekook\TelegramLibrary\TelegramBotApi $api)
    {
        parent::__construct($data, $api);

        $this->checkData("message", true);
        $this->message = new \Tekook\TelegramLibrary\Types\Message($data->message, $api);
    }

    /**
     * Returns the ID of the Update
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the Message object of the update
     * @return \Tekook\TelegramLibrary\Types\Message
     */
    public function getMessage()
    {
        return $this->message;
    }

}
