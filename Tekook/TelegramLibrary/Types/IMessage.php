<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 28.06.2015 23:00:40
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * represents a message
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface IMessage
{

    /**
     * Gets the message_id of the message
     * @return int
     */
    public function getMessageId();
    
    /**
     * Returns the id of the chat the message was received in
     * @return int
     */
    public function getFromChatId();
    
}
