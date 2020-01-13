<?php
/**
 * Event Manager for events and listeners.
 * Based on https://carlalexander.ca/designing-system-wordpress-event-management/
 *
 * @package WPMedia\EventManager
 */

namespace WPMedia\EventManager;

/**
 * The event manager manages events using the WordPress plugin API.
 */
class EventManager
{
    /**
     * WordPress plugin API manager
     *
     * @var PluginApiManager
     */
    private $plugin_api_manager;

    /**
     * Constructor
     *
     * @param PluginApiManager $plugin_api_manager WordPress plugin API manager.
     */
    public function __construct(PluginApiManager $plugin_api_manager)
    {
        $this->plugin_api_manager = $plugin_api_manager;
    }

    /**
     * Adds the given event listener to the list of event listeners
     *
     * @param string   $event_name     Name of the event.
     * @param callable $listener      Listener Callback function.
     * @param int      $priority      Priority.
     * @param int      $accepted_args Number of arguments.
     */
    public function addListener($event_name, $listener, $priority = 10, $accepted_args = 1)
    {
        $this->plugin_api_manager->addCallback($event_name, $listener, $priority, $accepted_args);
    }

    /**
     * Adds an event subscriber.
     *
     * The event manager adds the given subscriber to the list of event listeners
     * for all the events that it wants to listen to.
     *
     * @param SubscriberInterface $subscriber SubscriberInterface implementation.
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        if ($subscriber instanceof EventManagerAwareSubscriberInterface) {
            $subscriber->setEventManager($this);
        }

        foreach ($subscriber->getSubscribedEvents() as $event_name => $parameters) {
            $this->addSubscriberListener($subscriber, $event_name, $parameters);
        }
    }

    /**
     * Removes the given event listener from the list of event listeners
     * that listen to the given event.
     *
     * @param string   $event_name Event name.
     * @param callable $callback  Callback.
     * @param int      $priority  Priority.
     *
     * @return bool
     */
    public function removeListener($event_name, $callback, $priority = 10)
    {
        return $this->plugin_api_manager->removeCallback($event_name, $callback, $priority);
    }

    /**
     * Removes an event subscriber.
     *
     * The event manager removes the given subscriber from the list of event listeners
     * for all the events that it wants to listen to.
     *
     * @param SubscriberInterface $subscriber SubscriberInterface implementation.
     */
    public function removeSubscriber(SubscriberInterface $subscriber)
    {
        foreach ($subscriber->getSubscribedEvents() as $event_name => $parameters) {
            $this->removeSubscriberListener($subscriber, $event_name, $parameters);
        }
    }

    /**
     * Adds the given subscriber listener to the list of event listeners
     * that listen to the given event.
     *
     * @param SubscriberInterface $subscriber SubscriberInterface implementation.
     * @param string              $event_name Event name.
     * @param mixed               $parameters Parameters, can be a string, an array or a multidimensional array.
     */
    private function addSubscriberListener(SubscriberInterface $subscriber, $event_name, $parameters)
    {
        if (is_string($parameters)) {
            $this->addListener($event_name, [ $subscriber, $parameters ]);
        } elseif (is_array($parameters) && count($parameters) !== count($parameters, COUNT_RECURSIVE)) {
            foreach ($parameters as $parameter) {
                $this->addSubscriberListener($subscriber, $event_name, $parameter);
            }
        } elseif (is_array($parameters) && isset($parameters[0])) {
            $this->addListener($event_name, [ $subscriber, $parameters[0] ], isset($parameters[1]) ? $parameters[1] : 10, isset($parameters[2]) ? $parameters[2] : 1);
        }
    }

    /**
     * Removes the given subscriber listener to the list of event listeners
     * that listen to the given event.
     *
     * @param SubscriberInterface $subscriber SubscriberInterface implementation.
     * @param string              $event_name Event name.
     * @param mixed               $parameters Parameters, can be a string, an array or a multidimensional array.
     */
    private function removeSubscriberListener(SubscriberInterface $subscriber, $event_name, $parameters)
    {
        if (is_string($parameters)) {
            $this->removeListener($event_name, [ $subscriber, $parameters ]);
        } elseif (is_array($parameters) && count($parameters) !== count($parameters, COUNT_RECURSIVE)) {
            foreach ($parameters as $parameter) {
                $this->removeSubscriberListener($subscriber, $event_name, $parameter);
            }
        } elseif (is_array($parameters) && isset($parameters[0])) {
            $this->removeListener($event_name, [ $subscriber, $parameters[0] ], isset($parameters[1]) ? $parameters[1] : 10);
        }
    }
}
