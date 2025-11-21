<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\PluginApiManager;

use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the filter method
 *
 * @covers WPMedia\EventManager\PluginApiManager::filter
 * @group PluginApiManager
 */
class FilterTest extends TestCase {
	/**
	 * Test should assert the given filter was fired at least once
	 */
	public function testShouldAssertExecutedHook() {
		$plugin_api_manager = new PluginApiManager();

		$plugin_api_manager->filter( 'my_filter', 'filter value' );

		add_filter( 'my_filter', 'strtoupper' );

		$this->assertSame(
			10,
			has_filter( 'my_filter', 'strtoupper' )
		);
	}
}
