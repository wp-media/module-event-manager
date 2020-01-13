<?php

namespace WPMedia\EventManager\Tests\Unit\EventManager;

use WPMedia\EventManager\Tests\Unit\TestCase;
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
     * Test should remove listeners from events 5 times
     */
    public function testShouldRemoveListenersFromEventsFromSubscriber() {
        $plugin_api_manager = \Mockery::mock(PluginApiManager::class);
        $plugin_api_manager->shouldReceive('removeCallback')
        ->times(5);

        $manager = new EventManager($plugin_api_manager);

        $manager->removeSubscriber(new DummySubscriber());
    }
}
