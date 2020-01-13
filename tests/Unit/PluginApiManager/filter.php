<?php

namespace WPMedia\EventManager\Tests\Unit\PluginApiManager;

use WPMedia\EventManager\Tests\Unit\TestCase;
use Brain\Monkey\Filters;
use WPMedia\EventManager\PluginApiManager;

/**
 * Tests for the filter method
 *
 * @covers WPMedia\EventManager\PluginApiManager::filter
 * @group PluginApiManager
 */
class Test_Filter extends TestCase {
    /**
     * Test should assert the given filter was fired at least once
     */
    public function testShouldAssertExecutedHook() {
        $plugin_api_manager = new PluginApiManager();

        $plugin_api_manager->filter('my_filter', 'filter value');

        $this->assertTrue(Filters\applied('my_filter') > 0);
    }
}
