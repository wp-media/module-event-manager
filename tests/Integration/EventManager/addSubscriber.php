<?php

namespace WPMedia\EventManager\Tests\Integration\EventManager;

use WPMedia\EventManager\Tests\Integration\TestCase;
use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;

/**
 * Tests for the addSubscriber method
 *
 * @covers WPMedia\EventManager\PluginApiManager::addSubscriber
 * @group EventManager
 */
class Test_AddSubscriber extends TestCase {
    /**
     * Test should register listeners for each event listed in the subscriber
     */
    public function testShouldAddListenersToEventsFromSubscriber() {
        $manager    = new EventManager(new PluginApiManager());
        $subscriber = new DummySubscriber();

        $manager->addSubscriber($subscriber);

        $this->assertSame(
            10,
            has_filter('foo', [ $subscriber, 'bar' ])
        );
        $this->assertSame(
            20,
            has_filter('foofoo', [ $subscriber, 'barbar' ])
        );
        $this->assertSame(
            50,
            has_filter('foobar', [ $subscriber, 'foobarbar' ])
        );
        $this->assertSame(
            10,
            has_filter('barfoo', [ $subscriber, 'filter_this' ])
        );
        $this->assertSame(
            10,
            has_filter('barfoo', [ $subscriber, 'filter_that' ])
        );
    }
}
