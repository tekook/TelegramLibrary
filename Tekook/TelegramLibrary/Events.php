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

    /**
     * Event of a simple text message
     */
    const TEXT = 1;

    /**
     * Event of an audio file
     */
    const AUDIO = 2;

    /**
     * Event of a document file
     */
    const DOCUMENT = 3;

    /**
     * Event of a photo file
     */
    const PHOTO = 4;

    /**
     * Event of a sticker file
     */
    const STICKER = 5;

    /**
     * Event of a video file
     */
    const VIDEO = 6;

    /**
     * Event of an attached contact
     */
    const CONTACT = 7;

    /**
     * Event of an attached location
     */
    const LOCATION = 8;

    /**
     * Event of a new participant in a groupchat
     */
    const NEW_CHAT_PARTICIPANT = 9;

    /**
     * Event of a left participant in a groupchat
     */
    const LEFT_CHAT_PARTICIPANT = 10;

    /**
     * Event of a new title in a groupchat
     */
    const NEW_CHAT_TITLE = 11;

    /**
     * Event of a new photo in a groupchat
     */
    const NEW_CHAT_PHOTO = 12;

    /**
     * Event a the groupchat photo been deleted
     */
    const DELETE_CHAT_PHOTO = 13;

    /**
     * Event of a groupchat being created
     */
    const GROUP_CHAT_CREATED = 14;

    /**
     * Event of ANY file being received
     * ATTENTION this will only be called if the file type is NOT registered
     */
    const ANY_FILE = 15;

    /**
     * Event if the given event is not registered (e.g to capture events which the bot does not support)
     */
    const NOT_REGISTERED = 16;

}
