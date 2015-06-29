<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:48:06
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents an document file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Document extends File
{

    protected $fileType = "document";

    /**
     * The Thumbnail
     * @var \Tekook\TelegramLibrary\Types\PhotoSize
     */
    protected $thumb = array();

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->receiveData("thumb", null, "PhotoSize", true);


        $this->checkData("file_name", false, true);
        $this->checkData("mime_type", false, true);
    }

    /**
     * Returns the thumbnail
     * @return \Tekook\TelegramLibrary\Types\PhotoSize
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Returns the file name
     * @return string
     */
    public function getFileName()
    {
        return $this->data->file_name;
    }

    /**
     * Returns the mime type of the Document
     * @return string
     */
    public function getMimeType()
    {
        return $this->data->mime_type;
    }

}
