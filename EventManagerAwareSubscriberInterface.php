<?php
/**
 * Interface for subscribers who need access to the event manager object
 *
 * @package WPMedia\EventManager
 */

namespace WPMedia\EventManager;

interface EventManagerAwareSubscriberInterface extends SubscriberInterface
{
    /**
     * Set the WordPress event manager for the subscriber.
     *
     * @param EventManager $event_manager EventManager instance.
     */
    public function setEventManager(EventManager $event_manager);
}
