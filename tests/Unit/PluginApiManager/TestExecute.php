<?php

namespace WP_Media\EventManager\Tests\Unit\PluginApiManager;

use WP_Media\EventManager\Tests\Unit\TestCase;
use Brain\Monkey\Actions;
use WP_Media\EventManager\PluginApiManager;

/**
 * Tests for the execute method
 *
 * @covers WP_Media\EventManager\PluginApiManager::execute
 * @group PluginApiManager
 */
class TestExecute extends TestCase {
    /**
     * Test should assert the given action was fired once
     */
    public function testShouldAssertExecutedHook() {
        $plugin_api_manager = new PluginApiManager();

        $plugin_api_manager->execute('my_action');

        $this->assertSame(1, did_action('my_action'));
    }
}
