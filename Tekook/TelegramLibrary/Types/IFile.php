<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 28.06.2015 13:42:49
 * $Rev: 549 $
 * $Id: IFile.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents any file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface IFile
{

    /**
     * Returns the FileId of the file
     * @return int
     */
    public function getFileId();

    /**
     * Returns the file type of the file
     * @return string
     */
    public function getFileType();
}
