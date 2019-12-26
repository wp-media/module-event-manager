<?php
/**
 * Bootstraps the plugin's Unit Tests
 *
 * @package WP_Media\EventManager\Tests\Unit
 */

namespace WP_Media\EventManager\Tests\Unit;

use function WP_Media\EventManager\Tests\init_test_suite;

require_once dirname( dirname( __FILE__ ) ) . '/bootstrap-functions.php';
init_test_suite( 'Unit' );