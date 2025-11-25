<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\PluginApiManager;

use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the remove_callback method
 *
 * @covers WPMedia\EventManager\PluginApiManager::remove_callback
 * @group PluginApiManager
 */
class RemoveCallbackTest extends TestCase {
	/**
	 * Test should return true when the given callback is removed from the given hook
	 */
	public function testShouldReturnTrueWhenCallbackRemoved() {
		add_filter( 'the_content', 'strtolower' );

		$plugin_api_manager = new PluginApiManager();

		$this->assertTrue( $plugin_api_manager->remove_callback( 'the_content', 'strtolower' ) );
	}

	/**
	 * Test should return false when the given callback doesn't exist for the given hook
	 */
	public function testShouldReturnFalseWhenCallbackDoesNotExist() {
		add_filter( 'the_content', 'strtolower' );

		$plugin_api_manager = new PluginApiManager();

		$this->assertFalse( $plugin_api_manager->remove_callback( 'the_content', 'strtoupper' ) );
	}

	/**
	 * Test should return false when the given callback priority doesn't match with the priority when added
	 */
	public function testShouldReturnFalseWhenPriorityDoesNotMatch() {
		add_filter( 'the_content', 'strtolower' );

		$plugin_api_manager = new PluginApiManager();

		$this->assertFalse( $plugin_api_manager->remove_callback( 'the_content', 'strtolower', 100 ) );
	}

	/**
	 * Test should return true when the given callback priority matches with the priority when added
	 */
	public function testShouldReturnTrueWhenPriorityMatches() {
		add_filter( 'the_content', 'strtolower', 100 );

		$plugin_api_manager = new PluginApiManager();

		$this->assertTrue( $plugin_api_manager->remove_callback( 'the_content', 'strtolower', 100 ) );
	}
}
