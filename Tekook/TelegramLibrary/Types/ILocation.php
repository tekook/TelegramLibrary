<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 28.06.2015 22:47:04
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * represents a location
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface ILocation
{

    /**
     * Returns the longitude as defined by sende
     * @return float
     */
    public function getLongitude();

    /**
     * Returns the latitude as defined by sende
     * @return float
     */
    public function getLatitude();
}
