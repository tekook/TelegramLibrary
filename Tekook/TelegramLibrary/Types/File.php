<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:43:52
 * $Rev: 549 $
 * $Id: File.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Respresents any file 
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
abstract class File extends Type implements IFile
{

    /**
     * The Type of the file. E.g "audio", "video" ...
     * @var string
     */
    protected $fileType = null;

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("file_id", true);
        $this->checkData("file_size", false, true);
    }

    /**
     * Returns the file_id of the File
     * @return int
     */
    public function getFileId()
    {
        return $this->data->file_id;
    }

    /**
     * Returns the file_size of the File
     * @return int
     */
    public function getFileSize()
    {
        return $this->data->file_size;
    }

    /**
     * Returns the file type of the file
     * @return string
     */
    public function getFileType()
    {
        return $this->fileType;
    }

}
