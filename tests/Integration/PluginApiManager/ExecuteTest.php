<?php
declare(strict_types=1);

namespace WPMedia\EventManager\Tests\Integration\PluginApiManager;

use WPMedia\EventManager\PluginApiManager;
use WPMedia\EventManager\Tests\Integration\TestCase;

/**
 * Tests for the execute method
 *
 * @covers WPMedia\EventManager\PluginApiManager::execute
 * @group PluginApiManager
 */
class ExecuteTest extends TestCase {
	/**
	 * Test should assert the given action was fired once
	 */
	public function testShouldAssertExecutedHook() {
		$plugin_api_manager = new PluginApiManager();

		$plugin_api_manager->execute( 'my_action' );

		$this->assertSame( 1, did_action( 'my_action' ) );
	}
}
