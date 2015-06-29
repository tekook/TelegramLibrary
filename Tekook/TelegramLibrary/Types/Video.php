<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:50:42
 * $Rev: 549 $
 * $Id: Video.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a video file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Video extends Sticker
{

    protected $fileType = "video";

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("duration", true);
        $this->checkData("mime_type", false, true);
        $this->checkData("caption", false, true);
    }

    /**
     * Returns the duration of the video
     * @return int
     */
    public function getDuration()
    {
        return $this->data->duration;
    }

    /**
     * Returns the mime type of the Video
     * @return string
     */
    public function getMimeType()
    {
        return $this->data->mime_type;
    }

    /**
     * Returns the caption of the video
     * @return string
     */
    public function getCaption()
    {
        return $this->data->caption;
    }

}
