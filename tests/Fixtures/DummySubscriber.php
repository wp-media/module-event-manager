<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Fixtures;

use WPMedia\EventManager\SubscriberInterface;

/**
 * Dummy subscriber for tests
 */
class DummySubscriber implements SubscriberInterface {
	/**
	 * Get the events to which the subscriber wants to listen
	 *
	 * @return array<string, string|array<string, mixed>|array<array<string, mixed>>>
	 */
	public static function get_subscribed_events(): array {
		return [
			'foo'    => 'bar',
			'foofoo' => [ 'barbar', 20 ],
			'foobar' => [ 'foobarbar', 50, 3 ],
			'barfoo' => [
				[ 'filter_this' ],
				[ 'filter_that', 10, 2 ],
			],
		];
	}
}
