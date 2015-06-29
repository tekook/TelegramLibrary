<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 27.06.2015 18:55:00
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary;

/**
 * Contains the diffrent event types of message objects
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Events
{

    const TEXT = 1;
    const AUDIO = 2;
    const DOCUMENT = 3;
    const PHOTO = 4;
    const STICKER = 5;
    const VIDEO = 6;
    const CONTACT = 7;
    const LOCATION = 8;
    const NEW_CHAT_PARTICIPANT = 9;
    const LEFT_CHAT_PARTICIPANT = 10;
    const NEW_CHAT_TITLE = 11;
    const NEW_CHAT_PHOTO = 12;
    const DELETE_CHAT_PHOTO = 13;
    const GROUP_CHAT_CREATED = 14;
    const ANY_FILE = 15;

}
