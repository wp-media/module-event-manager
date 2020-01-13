<?php

namespace WPMedia\EventManager\Tests\Unit\PluginApiManager;

use WPMedia\EventManager\Tests\Unit\TestCase;
use WPMedia\EventManager\PluginApiManager;

/**
 * Tests for the removeCallback method
 *
 * @covers WPMedia\EventManager\PluginApiManager::removeCallback
 * @group PluginApiManager
 */
class Test_RemoveCallback extends TestCase {
    /**
     * Test should return true when the given callback is removed from the given hook
     */
    public function testShouldReturnTrueWhenCallbackRemoved() {
        add_filter('the_content', 'strtolower');

        $plugin_api_manager = new PluginApiManager();

        $this->assertTrue($plugin_api_manager->removeCallback('the_content', 'strtolower'));
    }

    /**
     * Test should return false when the given callback doesn't exist for the given hook
     */
    public function testShouldReturnFalseWhenCallbackDoesNotExist() {
        add_filter('the_content', 'strtolower');

        $plugin_api_manager = new PluginApiManager();

        $this->assertFalse($plugin_api_manager->removeCallback('the_content', 'strtoupper'));
    }

    /**
     * Test should return false when the given callback priority doesn't match with the priority when added
     */
    public function testShouldReturnFalseWhenPriorityDoesNotMatch() {
        add_filter('the_content', 'strtolower');

        $plugin_api_manager = new PluginApiManager();

        $this->assertFalse($plugin_api_manager->removeCallback('the_content', 'strtolower', 100));
    }

    /**
     * Test should return true when the given callback priority matches with the priority when added
     */
    public function testShouldReturnTrueWhenPriorityMatches() {
        add_filter('the_content', 'strtolower', 100);

        $plugin_api_manager = new PluginApiManager();

        $this->assertTrue($plugin_api_manager->removeCallback('the_content', 'strtolower', 100));
    }
}
