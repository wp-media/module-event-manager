<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\EventManager;

use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the remove_subscriber method
 *
 * @covers WPMedia\EventManager\EventManager::remove_subscriber
 * @group EventManager
 */
class RemoveSubscriberTest extends TestCase {
	/**
	 * Test should remove listeners from events listed in the subscriber
	 */
	public function testShouldRemoveListenersFromEventsFromSubscriber() {
		$manager    = new EventManager( new PluginApiManager() );
		$subscriber = new DummySubscriber();

		$manager->add_subscriber( $subscriber );
		$manager->remove_subscriber( $subscriber );

		$this->assertFalse( has_filter( 'foo', [ $subscriber, 'bar' ] ) );
		$this->assertFalse( has_filter( 'foofoo', [ $subscriber, 'barbar' ] ) );
		$this->assertFalse( has_filter( 'foobar', [ $subscriber, 'foobarbar' ] ) );
		$this->assertFalse( has_filter( 'barfoo', [ $subscriber, 'filter_this' ] ) );
		$this->assertFalse( has_filter( 'barfoo', [ $subscriber, 'filter_that' ] ) );
	}
}
