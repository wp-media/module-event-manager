<?php

namespace WP_Media\EventManager\Tests\Unit\EventManager;

use WP_Media\EventManager\Tests\Unit\TestCase;
use WP_Media\EventManager\EventManager;
use WP_Media\EventManager\PluginApiManager;
use WP_Media\EventManager\Tests\Fixtures\DummySubscriber;

/**
 * Tests for the removeSubscriber method
 *
 * @covers WP_Media\EventManager\PluginApiManager::removeSubscriber
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
