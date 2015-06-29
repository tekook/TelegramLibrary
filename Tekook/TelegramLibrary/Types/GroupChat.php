<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:40:44
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents an GroupChat
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class GroupChat extends Type implements IChat
{

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("id", true);
        $this->checkData("title", true);
    }

    /**
     * Returns the id of the groupchat
     * @return int
     */
    public function getId()
    {
        return $this->data->id;
    }

    /**
     * Returns the title of the groupchat
     * @return string
     */
    public function getTitle()
    {
        return $this->data->title;
    }

    /**
     * Returns the title of the groupchat
     * @return string
     */
    public function getName()
    {
        return $this->getTitle();
    }

}
