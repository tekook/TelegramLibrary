<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:48:53
 * $Rev: 549 $
 * $Id: Sticker.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * represents a sticker file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Sticker extends PhotoSize
{

    protected $fileType = "sticker";

    /**
     * The Thumbnail
     * @var \Tekook\TelegramLibrary\Types\PhotoSize
     */
    protected $thumb;

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->receiveData("thumb", null, "PhotoSize", true);
    }

    /**
     * Returns the thumbnail
     * @return \Tekook\TelegramLibrary\Types\PhotoSize
     */
    public function getThumb()
    {
        return $this->thumb;
    }

}
