<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:44:51
 * $Rev: 549 $
 * $Id: PhotoSize.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a photo file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class PhotoSize extends File
{

    protected $fileType = "photo";

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("width", true);
        $this->checkData("height", true);
    }

    /**
     * Returns the width of the photo
     * @return int
     */
    public function getWidth()
    {
        return $this->data->width;
    }

    /**
     * Returns the height of the photo
     * @return int
     */
    public function getHeight()
    {
        return $this->data->height;
    }

}
