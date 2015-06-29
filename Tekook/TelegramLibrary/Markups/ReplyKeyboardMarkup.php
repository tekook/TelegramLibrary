<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 29.06.2015 13:41:37
 * $Rev$
 * $Id$
 */

namespace Tekook\TelegramLibrary\Markups;

/**
 * Description of ReplyKeyboardMarkup
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class ReplyKeyboardMarkup implements IReplyMarkup
{

    protected $keyboard;
    protected $resizeKeyboard = false;
    protected $oneTimeKeyboard = false;
    protected $selective = false;

    public function __construct(array $keyboard, $resizeKeyboard = false, $oneTimeKeyboard = false, $selective = false)
    {
        $this->keyboard = $keyboard;
        $this->resizeKeyboard = $resizeKeyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->selective = $selective;
    }

    /**
     * Returns the object as JSON string
     * @return string
     */
    public function toJson()
    {
        return json_encode([
            "keyboard" => $this->keyboard,
            "resize_keyboard" => $this->resizeKeyboard,
            "one_time_keyboard" => $this->oneTimeKeyboard,
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
