<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:59:43
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents the profile photos of a given user
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class UserProfilePhotos extends Type
{

    protected $photos = array();

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("total_count", true);
        $this->checkData("photos", true);

        foreach ($data->photos as $key => $photos) {
            $this->photos[$key] = array();
            foreach ($photos as $photo) {
                $this->photos[$key][] = new PhotoSize($photo);
            }
        }
    }

    /**
     * Gets the total number of profile photos
     * @return int
     */
    public function getTotalCount()
    {
        return $this->data->total_count;
    }

    /**
     * Return the Array of user Photos each containing an array of PhotoSizes
     * @return array:array:PhotoSize
     */
    public function getPhotos()
    {
        return $this->photos;
    }

}
