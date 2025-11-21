<?php
declare( strict_types=1 );

namespace WPMedia\EventManager\Tests\Unit\EventManager;

use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;
use WPMedia\EventManager\Tests\Unit\TestCase;

/**
 * Tests for the remove_subscriber method
 *
 * @covers WPMedia\EventManager\EventManager::remove_subscriber
 * @group EventManager
 */
class RemoveSubscriberTest extends TestCase {
	/**
	 * Test should remove listeners from events 5 times
	 */
	public function testShouldRemoveListenersFromEventsFromSubscriber() {
		$plugin_api_manager = \Mockery::mock( PluginApiManager::class );
		$plugin_api_manager->shouldReceive( 'remove_callback' )
		->times( 5 );

		$manager = new EventManager( $plugin_api_manager );

		$manager->remove_subscriber( new DummySubscriber() );
	}
}
