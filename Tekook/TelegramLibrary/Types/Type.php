<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 26.06.2015 18:37:53
 * $Rev: 549 $
 * $Id: Type.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary\Types;

/**
 * Base class for any Type
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
abstract class Type
{

    /**
     * Die Data des JSON-Obj
     * @var \stdClass
     */
    protected $data = null;

    /**
     * The api the type belongs to
     * @var \Tekook\TelegramLibrary\TelegramBotApi
     */
    protected $api = null;

    public function __construct(\stdClass $data, \Tekook\TelegramLibrary\TelegramBotApi $api = null)
    {
        $this->data = $data;
        $this->api = $api;
    }

    /**
     * Prüft die angegeben Key ob dieser existiert, wirf je nach Parameter eine Exception oder setzt den Parameter auf null
     * @param string $key Der zuprüfende Key
     * @param boolean $mandatory Gibt an, ob eine Exception ausgeworfen wird
     * @param boolean $setNull Gibt an, ob der Data-Key auf NULL gesetzt werden soll
     * @return boolean
     * @throws \Tekook\TelegramLibrary\Exceptions\MissingKeyException
     */
    protected function checkData($key, $mandatory = false, $setNull = false)
    {
        if (isset($this->data->{$key})) {
            return true;
        } elseif ($mandatory) {
            $this->throwMissingError($key);
        } elseif ($setNull) {
            $this->data->{$key} = null;
        }
        return false;
    }

    /**
     * Prüft den Key und erstellt das entsprechende Object
     * @param string $key Der Key in $this->data
     * @param string $iKey Der Key in $this (wenn null wird $key benutzt)
     * @param string $class Die Klasse die erstellt werden soll (wenn null wird KEINE Klasse erstellt sondern die RAWDATEN genommen)
     * @param boolean $mandatory Defindes if the key is mandatory
     * @return boolean
     * @throws \Tekook\TelegramLibrary\Exceptions\MissingKeyException
     */
    protected function receiveData($key, $iKey = null, $class = null, $mandatory = false)
    {
        $class = "\\Tekook\\TelegramLibrary\\Types\\" . $class;
        if (is_null($iKey)) {
            $iKey = $key;
        }
        if ($this->checkData($key, $mandatory)) {
            if (is_null($class)) {
                $this->{$iKey} = $this->data->{$key};
            } else {
                $this->{$iKey} = new $class($this->data->{$key}, $this->api);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Throws a MissingKeyException if needed
     * @param string $key
     * @throws \Tekook\TelegramLibrary\Exceptions\MissingKeyException
     */
    protected function throwMissingError($key)
    {
        throw new \Tekook\TelegramLibrary\Exceptions\MissingKeyException("key: $key is missing in data!");
    }

}
