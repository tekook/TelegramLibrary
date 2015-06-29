<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 29.06.2015 13:46:21
 * $Rev: 549 $
 * $Id: ReplyKeyboardHide.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Markups;

/**
 * Description of ReplyKeyboardHide
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class ReplyKeyboardHide implements IReplyMarkup
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
            "hide_keyboard" => true,
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
