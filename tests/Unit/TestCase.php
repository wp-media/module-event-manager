<?php
/**
 * Test Case for all of the unit tests.
 *
 * @package WP_Media\EventManager\Tests\Unit
 */

namespace WP_Media\EventManager\Tests\Unit;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Brain\Monkey;
use WP_Media\EventManager\Tests\TestCaseTrait;

abstract class TestCase extends PHPUnitTestCase {
    use \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
    use TestCaseTrait;

    /**
     * Prepares the test environment before each test.
     */
    protected function setUp() {
        parent::setUp();
        Monkey\setUp();
    }

    /**
     * Cleans up the test environment after each test.
     */
    protected function tearDown() {
        Monkey\tearDown();
        parent::tearDown();
    }
}
