<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 19:40:56
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a chat (user or group chat)
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface IChat
{

    /**
     * Returns the chat_id of the User or GroupChat
     * @return int
     */
    public function getId();

    /**
     * Returns the name of the User or GroupChat
     * @return string
     */
    public function getName();
}
