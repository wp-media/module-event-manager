<?php
declare(strict_types=1);

namespace WPMedia\EventManager;

/**
 * Interface for subscribers who need access to the event manager object
 */
interface EventManagerAwareSubscriberInterface extends SubscriberInterface {
	/**
	 * Set the WordPress event manager for the subscriber.
	 *
	 * @param EventManager $event_manager EventManager instance.
	 */
	public function set_event_manager( EventManager $event_manager ): void;
}
