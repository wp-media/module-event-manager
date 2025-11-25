<?php
declare(strict_types=1);

namespace WPMedia\EventManager;

/**
 * The event manager manages events using the WordPress plugin API.
 */
class EventManager {
	/**
	 * WordPress plugin API manager
	 *
	 * @var PluginApiManager
	 */
	private PluginApiManager $plugin_api_manager;

	/**
	 * Constructor
	 *
	 * @param PluginApiManager $plugin_api_manager WordPress plugin API manager.
	 */
	public function __construct( PluginApiManager $plugin_api_manager ) {
		$this->plugin_api_manager = $plugin_api_manager;
	}

	/**
	 * Adds the given event listener to the list of event listeners
	 *
	 * @param string   $event_name     Name of the event.
	 * @param callable $listener      Listener Callback function.
	 * @param int      $priority      Priority.
	 * @param int      $accepted_args Number of arguments.
	 *
	 * @return void
	 */
	public function add_listener( $event_name, $listener, $priority = 10, $accepted_args = 1 ): void {
		$this->plugin_api_manager->add_callback( $event_name, $listener, $priority, $accepted_args );
	}

	/**
	 * Adds an event subscriber.
	 *
	 * The event manager adds the given subscriber to the list of event listeners
	 * for all the events that it wants to listen to.
	 *
	 * @param SubscriberInterface $subscriber SubscriberInterface implementation.
	 */
	public function add_subscriber( SubscriberInterface $subscriber ): void {
		if ( $subscriber instanceof EventManagerAwareSubscriberInterface ) {
			$subscriber->set_event_manager( $this );
		}

		foreach ( $subscriber->get_subscribed_events() as $event_name => $parameters ) {
			$this->add_subscriber_listener( $subscriber, $event_name, $parameters );
		}
	}

	/**
	 * Removes the given event listener from the list of event listeners
	 * that listen to the given event.
	 *
	 * @param string                $event_name Event name.
	 * @param callable|string|array $callback  Callback.
	 * @param int                   $priority  Priority.
	 *
	 * @return bool
	 */
	public function remove_listener( $event_name, $callback, $priority = 10 ): bool {
		return $this->plugin_api_manager->remove_callback( $event_name, $callback, $priority );
	}

	/**
	 * Removes an event subscriber.
	 *
	 * The event manager removes the given subscriber from the list of event listeners
	 * for all the events that it wants to listen to.
	 *
	 * @param SubscriberInterface $subscriber SubscriberInterface implementation.
	 */
	public function remove_subscriber( SubscriberInterface $subscriber ): void {
		foreach ( $subscriber->get_subscribed_events() as $event_name => $parameters ) {
			$this->remove_subscriber_listener( $subscriber, $event_name, $parameters );
		}
	}

	/**
	 * Adds the given subscriber listener to the list of event listeners
	 * that listen to the given event.
	 *
	 * @param SubscriberInterface $subscriber SubscriberInterface implementation.
	 * @param string              $event_name Event name.
	 * @param string|array        $parameters Parameters, can be a string, an array or a multidimensional array.
	 */
	private function add_subscriber_listener( SubscriberInterface $subscriber, $event_name, $parameters ): void {
		if ( is_string( $parameters ) ) {
			$this->add_listener( $event_name, [ $subscriber, $parameters ] );
		} elseif ( count( $parameters ) !== count( $parameters, COUNT_RECURSIVE ) ) {
			foreach ( $parameters as $parameter ) {
				$this->add_subscriber_listener( $subscriber, $event_name, $parameter );
			}
		} elseif ( isset( $parameters[0] ) ) {
			$this->add_listener( $event_name, [ $subscriber, $parameters[0] ], isset( $parameters[1] ) ? $parameters[1] : 10, isset( $parameters[2] ) ? $parameters[2] : 1 );
		}
	}

	/**
	 * Removes the given subscriber listener from the list of event listeners
	 * that listen to the given event.
	 *
	 * @param SubscriberInterface $subscriber SubscriberInterface implementation.
	 * @param string              $event_name Event name.
	 * @param string|array        $parameters Parameters, can be a string, an array or a multidimensional array.
	 */
	private function remove_subscriber_listener( SubscriberInterface $subscriber, $event_name, $parameters ): void {
		if ( is_string( $parameters ) ) {
			$this->remove_listener( $event_name, [ $subscriber, $parameters ] );
		} elseif ( count( $parameters ) !== count( $parameters, COUNT_RECURSIVE ) ) {
			foreach ( $parameters as $parameter ) {
				$this->remove_subscriber_listener( $subscriber, $event_name, $parameter );
			}
		} elseif ( isset( $parameters[0] ) ) {
			$this->remove_listener( $event_name, [ $subscriber, $parameters[0] ], isset( $parameters[1] ) ? $parameters[1] : 10 );
		}
	}
}
