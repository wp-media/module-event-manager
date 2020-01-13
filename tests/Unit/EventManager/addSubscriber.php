<?php

namespace WPMedia\EventManager\Tests\Unit\EventManager;

use WPMedia\EventManager\Tests\Unit\TestCase;
use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Fixtures\DummySubscriber;

/**
 * Tests for the addSubscriber
 *
 * @covers WPMedia\EventManager\PluginApiManager::addSubscriber
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
