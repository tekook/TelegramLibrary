<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 28.06.2015 19:08:02
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a user
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface IUser
{

    /**
     * The ID of the User
     * @return int
     */
    public function getId();

    /**
     * The first name of the user
     * @return string
     */
    public function getFirstName();
}
