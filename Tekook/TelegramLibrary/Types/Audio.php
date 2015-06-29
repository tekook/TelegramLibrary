<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:47:17
 * $Rev: 549 $
 * $Id: Audio.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents an audio file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Audio extends File
{

    protected $fileType = "audio";

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("duration", true);
        $this->checkData("mime_type", false, true);
    }

    /**
     * Returns the duration of the AudioFile
     * @return int
     */
    public function getDuration()
    {
        return $this->data->duration;
    }

    /**
     * Returns the mime type of the AudioFile
     * @return string
     */
    public function getMimeType()
    {
        return $this->data->mime_type;
    }

}
