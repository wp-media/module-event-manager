<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\EventManager;

use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the add_subscriber method
 *
 * @covers WPMedia\EventManager\EventManager::add_subscriber
 * @group EventManager
 */
class AddSubscriberTest extends TestCase {
	/**
	 * Test should register listeners for each event listed in the subscriber
	 */
	public function testShouldAddListenersToEventsFromSubscriber() {
		$manager    = new EventManager( new PluginApiManager() );
		$subscriber = new DummySubscriber();

		$manager->add_subscriber( $subscriber );

		$this->assertSame(
			10,
			has_filter( 'foo', [ $subscriber, 'bar' ] )
		);
		$this->assertSame(
			20,
			has_filter( 'foofoo', [ $subscriber, 'barbar' ] )
		);
		$this->assertSame(
			50,
			has_filter( 'foobar', [ $subscriber, 'foobarbar' ] )
		);
		$this->assertSame(
			10,
			has_filter( 'barfoo', [ $subscriber, 'filter_this' ] )
		);
		$this->assertSame(
			10,
			has_filter( 'barfoo', [ $subscriber, 'filter_that' ] )
		);
	}
}
