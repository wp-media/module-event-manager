<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\PluginApiManager;

use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the has_callback method
 *
 * @covers WPMedia\EventManager\PluginApiManager::has_callback
 * @group PluginApiManager
 */
class HasCallbackTest extends TestCase {
	/**
	 * Test should return false when no callback is attached to the given hook.
	 */
	public function testShouldReturnFalseWhenNoCallbackAttached() {
		$plugin_api_manager = new PluginApiManager();

		$this->assertFalse( $plugin_api_manager->has_callback( 'my_custom_filter' ) );
	}

	/**
	 * Test should return true when a callback is attached to the given hook.
	 */
	public function testShouldReturnTrueWhenCallbackAttached() {
		add_filter( 'the_content', 'strtolower' );

		$plugin_api_manager = new PluginApiManager();

		$this->assertTrue( $plugin_api_manager->has_callback( 'the_content' ) );
	}

	/**
	 * Test should return false when the given callback is not attached to the given hook.
	 */
	public function testShouldReturnFalseWhenCallbackNotAttached() {
		add_filter( 'the_content', 'strtolower' );

		$plugin_api_manager = new PluginApiManager();

		$this->assertFalse( $plugin_api_manager->has_callback( 'the_content', 'strtoupper' ) );
	}

	/**
	 * Test should return true when the given callback is attached to the given hook.
	 */
	public function testShouldReturnPriorityIntWhenCallbackAttached() {
		add_filter( 'the_content', 'strtolower', 11 );

		$plugin_api_manager = new PluginApiManager();

		$this->assertSame(
			11,
			$plugin_api_manager->has_callback( 'the_content', 'strtolower' )
		);
	}
}
