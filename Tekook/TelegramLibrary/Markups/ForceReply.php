<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 29.06.2015 13:46:21
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Markups;

/**
 * Description of ForceReply
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class ForceReply implements IReplyMarkup
{

    protected $selective = false;

    public function __construct($selective = false)
    {
        $this->selective = $selective;
    }

    /**
     * Returns the object as JSON string
     * @return string
     */
    public function toJson()
    {
        return json_encode([
            "force_reply" => true,
            "selective" => $this->selective,
        ]);
    }

    /**
     * Returns the object as JSON string
     * @return string
     */
    public function toString()
    {
        return $this->toJson();
    }

    /**
     * Returns the object as JSON string
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

}
