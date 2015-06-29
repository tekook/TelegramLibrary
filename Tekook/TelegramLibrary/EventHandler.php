<?php

/**
 * @author: Julian 'Digital' Tekook <digi@netjumpers.eu>
 * @company: NetJumpers.EU
 * @copyright: 2015
 * @created: 29.06.2015 12:50:41
 * $Rev: 549 $
 * $Id: EventHandler.php 549 2015-06-29 19:19:59Z julian $
 */

namespace Tekook\TelegramLibrary;

/**
 * Manager for all events. You an hook an event here
 * 
 * @author Julian 'Digital' Tekook <digi@netjumpers.eu>
 */
class EventHandler
{

    /**
     * The api the handler belongs to
     * @var \Tekook\TelegramLibrary\TelegramBotApi
     */
    protected $api;

    /**
     * Events with closures
     * @var array
     */
    protected $events = array();

    public function __construct(\Tekook\TelegramLibrary\TelegramBotApi $api)
    {
        $this->api = $api;
    }

    /**
     * Point to handle events
     * @param \Tekook\TelegramLibrary\Types\Update $update
     */
    public function handle(\Tekook\TelegramLibrary\Types\Update $update)
    {
        $message = $update->getMessage();

        if (isset($this->events[$message->getEvent()])) {
            foreach ($this->events[$message->getEvent()] as $closure) {
                $closure($message);
            }
        } elseif ($message->isFile() && isset($this->events[Events::ANY_FILE])) {
            foreach ($this->events[Events::ANY_FILE] as $closure) {
                $closure($message);
            }
        } elseif (isset($this->events[Events::NOT_REGISTERED])) {
            foreach ($this->events[Events::NOT_REGISTERED] as $closure) {
                $closure($message);
            }
        }
    }

    /**
     * Adds a new hook the the event handler.
     * Returns the ID of the added hook
     * @param int $event ID of the Event. @see \Tekook\TelegramLibrary\Events
     * @param \Closure $closure Closure to execute
     * @return int
     */
    public function addHook($event, \Closure $closure)
    {
        if (!is_int($event)) {
            throw new Exceptions\ArgumentException("Argument \$event must be int.");
        }

        if (!isset($this->events[$event])) {
            $this->events[$event] = array();
        }
        $this->events[$event][] = $closure;
        return count($this->events[$event]) - 1;
    }

    /**
     * Removes the hook if it exists
     * @param int $event
     * @param int $id
     */
    public function removeHook($event, $id)
    {
        if (isset($this->events[$event]) && isset($this->events[$event][$id])) {
            unset($this->events[$event][$id]);
        }
    }

}
