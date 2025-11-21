<?php
declare( strict_types=1 );

namespace WPMedia\EventManager\Tests\Unit\PluginApiManager;

use Brain\Monkey\Filters;
use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Unit\TestCase;

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
		Filters\expectAdded( 'the_content' )
		->with( 'strtolower', 10, 1 );

		$plugin_api_manager = new PluginApiManager();
		$plugin_api_manager->add_callback( 'the_content', 'strtolower' );
	}

	/**
	 * Test should add a new filter with a priority 100 and 3 arguments
	 */
	public function testShouldAddNewFilterWithAllParameters() {
		Filters\expectAdded( 'the_content' )
		->with( 'strtolower', 100, 3 );

		$plugin_api_manager = new PluginApiManager();
		$plugin_api_manager->add_callback( 'the_content', 'strtolower', 100, 3 );
	}
}
