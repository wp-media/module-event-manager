<?php
/**
 * Bootstraps the plugin's Unit Tests
 *
 * @package WPMedia\EventManager\Tests\Unit
 */

namespace WPMedia\EventManager\Tests\Unit;

use function WPMedia\EventManager\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/bootstrap-functions.php';
init_test_suite( 'Unit' );