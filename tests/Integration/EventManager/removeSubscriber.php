<?php

namespace WPMedia\EventManager\Tests\Integration\EventManager;

use WPMedia\EventManager\Tests\Integration\TestCase;
use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;

/**
 * Tests for the removeSubscriber method
 *
 * @covers WPMedia\EventManager\PluginApiManager::removeSubscriber
 * @group EventManager
 */
class Test_RemoveSubscriber extends TestCase {
    /**
     * Test should remove listeners from events listed in the subscriber
     */
    public function testShouldRemoveListenersFromEventsFromSubscriber() {
        $manager    = new EventManager(new PluginApiManager());
        $subscriber = new DummySubscriber();

        $manager->addSubscriber($subscriber);
        $manager->removeSubscriber($subscriber);

        $this->assertFalse(has_filter('foo', [ $subscriber, 'bar' ]));
        $this->assertFalse(has_filter('foofoo', [ $subscriber, 'barbar' ]));
        $this->assertFalse(has_filter('foobar', [ $subscriber, 'foobarbar' ]));
        $this->assertFalse(has_filter('barfoo', [ $subscriber, 'filter_this' ]));
        $this->assertFalse(has_filter('barfoo', [ $subscriber, 'filter_that' ]));
    }
}
