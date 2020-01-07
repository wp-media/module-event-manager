<?php

namespace WP_Media\EventManager\Tests\Integration\PluginApiManager;

use WP_Media\EventManager\Tests\Integration\TestCase;
use Brain\Monkey\Filters;
use WP_Media\EventManager\PluginApiManager;

/**
 * Tests for the filter method
 *
 * @covers WP_Media\EventManager\PluginApiManager::filter
 * @group PluginApiManager
 */
class Test_Filter extends TestCase {
    /**
     * Test should assert the given filter was fired at least once
     */
    public function testShouldAssertExecutedHook() {
        $plugin_api_manager = new PluginApiManager();

        $plugin_api_manager->filter('my_filter', 'filter value');

        add_filter('my_filter', 'strtoupper');

        $this->assertSame(
            10,
            has_filter('my_filter', 'strtoupper')
        );
    }
}
