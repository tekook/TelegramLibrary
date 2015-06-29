<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:52:40
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents an contact file
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Contact extends Type
{

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("phone_number", true);
        $this->checkData("first_name", true);
        $this->checkData("last_name", false, true);
        $this->checkData("user_id", false, true);
    }

    /**
     * Returns the phone number of the contact
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->data->phone_number;
    }

    /**
     * Returns the first name of the contact
     * @return string
     */
    public function getFirstName()
    {
        return $this->data->first_name;
    }

    /**
     * Returns the last name of the contact
     * @return string
     */
    public function getLastName()
    {
        return $this->data->last_name;
    }

    /**
     * Returns the user id of the telegram user
     * @return int
     */
    public function getUserId()
    {
        return $this->data->user_id;
    }

}
