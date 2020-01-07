<?php

namespace WP_Media\EventManager\Tests\Unit\EventManager;

use WP_Media\EventManager\Tests\Unit\TestCase;
use WP_Media\EventManager\EventManager;
use WP_Media\EventManager\PluginApiManager;
use WP_Media\EventManager\Tests\Fixtures\DummySubscriber;

/**
 * Tests for the addSubscriber
 *
 * @covers WP_Media\EventManager\PluginApiManager::addSubscriber
 * @group EventManager
 */
class Test_AddSubscriber extends TestCase {
    /**
     * Test should register listeners to events 5 times
     */
    public function testShouldAddListenersToEventsFromSubscriber() {
        $plugin_api_manager = \Mockery::mock(PluginApiManager::class);
        $plugin_api_manager->shouldReceive('addCallback')
        ->times(5);

        $manager = new EventManager($plugin_api_manager);

        $manager->addSubscriber(new DummySubscriber());
    }
}
