<?php
/**
 * Test Case for all of the integration tests.
 *
 * @package WPMedia\EventManager\Tests\Integration
 */

namespace WPMedia\EventManager\Tests\Integration;

use Brain\Monkey;
use WPMedia\EventManager\Tests\TestCaseTrait;
use WP_UnitTestCase;

abstract class TestCase extends WP_UnitTestCase {
    use TestCaseTrait;
    /**
     * Prepares the test environment before each test.
     */
    public function setUp() {
        parent::setUp();
        Monkey\setUp();
    }

    /**
     * Cleans up the test environment after each test.
     */
    public function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}
