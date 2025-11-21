<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\PluginApiManager;

use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the add_callback method
 *
 * @covers WPMedia\EventManager\PluginApiManager::add_callback
 * @group PluginApiManager
 */
class AddCallbackTest extends TestCase {
	/**
	 * Test should add a new filter with default priority and arguments
	 */
	public function testShouldAddNewFilterWithDefaultParameters() {
		$plugin_api_manager = new PluginApiManager();
		$plugin_api_manager->add_callback( 'the_content', 'strtolower' );

		$this->assertSame(
			10,
			has_filter( 'the_content', 'strtolower' )
		);
	}

	/**
	 * Test should add a new filter with a priority 100 and 3 arguments
	 */
	public function testShouldAddNewFilterWithAllParameters() {
		$plugin_api_manager = new PluginApiManager();
		$plugin_api_manager->add_callback( 'the_content', 'strtolower', 100, 3 );

		$this->assertSame(
			100,
			has_filter( 'the_content', 'strtolower' )
		);
	}
}
