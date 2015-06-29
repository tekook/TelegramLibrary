<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 29.06.2015 13:40:41
 * $Rev: 549 $
 * $Id: IReplyMarkup.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Markups;

/**
 * Description of IReplyMarkup
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
interface IReplyMarkup
{

    /**
     * Returns the Object as json string
     * @return string
     */
    public function toJson();

    /**
     * Returns the object as string
     * @return string
     */
    public function toString();

    /**
     * Returns the object as string
     * @return string
     */
    public function __toString();
}
