<?php
declare( strict_types=1 );

namespace WPMedia\EventManager\Tests\Unit\EventManager;

use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;
use WPMedia\EventManager\Tests\Unit\TestCase;

/**
 * Tests for the add_subscriber
 *
 * @covers WPMedia\EventManager\EventManager::add_subscriber
 * @group EventManager
 */
class AddSubscriberTest extends TestCase {
	/**
	 * Test should register listeners to events 5 times
	 */
	public function testShouldAddListenersToEventsFromSubscriber() {
		$plugin_api_manager = \Mockery::mock( PluginApiManager::class );
		$plugin_api_manager->shouldReceive( 'add_callback' )
		->times( 5 );

		$manager = new EventManager( $plugin_api_manager );

		$manager->add_subscriber( new DummySubscriber() );
	}
}
