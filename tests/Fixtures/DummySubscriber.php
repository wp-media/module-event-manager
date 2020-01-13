<?php

namespace WPMedia\EventManager\Tests\Fixtures;

use WPMedia\EventManager\SubscriberInterface;

/**
 * Dummy subscriber for tests
 */
class DummySubscriber implements SubscriberInterface {
    public static function getSubscribedEvents() {
        return [
            'foo' => 'bar',
            'foofoo' => [ 'barbar', 20 ],
            'foobar' => [ 'foobarbar', 50, 3 ],
            'barfoo' => [
                [ 'filter_this' ],
                [ 'filter_that', 10, 2 ],
            ],
        ];
    }
}
