<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 20:54:12
 * $Rev: 549 $
 * $Id: Location.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Represents a location
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class Location extends Type implements ILocation
{

    public function __construct(\stdClass $data)
    {
        parent::__construct($data);

        $this->checkData("longitude", true);
        $this->checkData("latitude", true);
    }

    /**
     * Returns the longitude as defined by sende
     * @return float
     */
    public function getLongitude()
    {
        return $this->data->longitude;
    }

    /**
     * Returns the latitude as defined by sende
     * @return float
     */
    public function getLatitude()
    {
        return $this->data->latitude;
    }

}
