<?php

namespace WPMedia\EventManager\Tests\Unit\PluginApiManager;

use WPMedia\EventManager\Tests\Unit\TestCase;
use Brain\Monkey\Filters;
use WPMedia\EventManager\PluginApiManager;

/**
 * Tests for the addCallback method
 *
 * @covers WPMedia\EventManager\PluginApiManager::addCallback
 * @group PluginApiManager
 */
class Test_AddCallback extends TestCase {
    /**
     * Test should add a new filter with default priority and arguments
     */
    public function testShouldAddNewFilterWithDefaultParameters() {
        Filters\expectAdded('the_content')
        ->with('strtolower', 10, 1);

        $plugin_api_manager = new PluginApiManager();
        $plugin_api_manager->addCallback('the_content', 'strtolower');
    }

    /**
     * Test should add a new filter with a priority 100 and 3 arguments
     */
    public function testShouldAddNewFilterWithAllParameters() {
        Filters\expectAdded('the_content')
        ->with('strtolower', 100, 3);

        $plugin_api_manager = new PluginApiManager();
        $plugin_api_manager->addCallback('the_content', 'strtolower', 100, 3);
    }
}
