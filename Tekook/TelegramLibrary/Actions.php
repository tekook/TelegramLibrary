<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 28.06.2015 22:56:12
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary;

/**
 * Contains the diffrent actions which can be used for sendChatAction
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Actions
{
    const TYPING = "typing";
    const UPLOADING_PHOTO = "upload_photo";
    const UPLOADING_VIDEO = "upload_video";
    const UPLOADING_AUDIO = "upload_audio";
    const UPLOADING_DOCUMENT = "upload_document";
    const FINDING_LOCATION = "find_location";
    const RECORDING_VIDEO = "record_video";
}
