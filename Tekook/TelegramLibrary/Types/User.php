<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 18:35:24
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a user
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class User extends Type implements IChat, IUser {



    public function __construct(\stdClass $data, \Tekook\TelegramLibrary\TelegramBotApi $api) {
        parent::__construct($data, $api);

        $this->checkData("id", true);
        $this->checkData("first_name", true);
        $this->checkData("last_name", false, true);
        $this->checkData("username", false, true);
    }

    /**
     * Returns the user_id of the user
     * @return int
     */
    public function getId() {
        return $this->data->id;
    }

    /**
     * Returns the first name of the user
     * @return string
     */
    public function getFirstName() {
        return $this->data->first_name;
    }

    /**
     * Returns the last name of the user
     * @return string
     */
    public function getLastName() {
        return $this->data->last_name;
    }

    /**
     * Returns the user name of the user
     * @return string
     */
    public function getUserName() {
        return $this->data->username;
    }

    /**
     * Returns the first name of the User
     * @return string
     */
    public function getName() {
        return $this->getFirstName();
    }

    /**
     * Returns the ProfilePhotos of the User
     * @param int $offset Optional offset
     * @param int $limit Optional limit
     * @return \Tekook\TelegramLibrary\Types\UserProfilePhotos
     */
    public function getProfilePhotos($offset = 0, $limit = 100) {
        return $this->api->getUserProfilePhotos($this, $offset, $limit);
    }

}
