<?php

namespace WP_Media\EventManager\Tests\Unit\PluginApiManager;

use WP_Media\EventManager\Tests\Unit\TestCase;
use Brain\Monkey\Filters;
use WP_Media\EventManager\PluginApiManager;

/**
 * Tests for the filter method
 *
 * @covers WP_Media\EventManager\PluginApiManager::filter
 * @group PluginApiManager
 */
class TestFilter extends TestCase {
    /**
     * Test should assert the given filter was fired at least once
     */
    public function testShouldAssertExecutedHook() {
        $plugin_api_manager = new PluginApiManager();

        $plugin_api_manager->filter('my_filter', 'filter value');

        $this->assertTrue(Filters\applied('my_filter') > 0);
    }
}
