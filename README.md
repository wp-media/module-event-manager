# Event Manager
Event management system for WordPress

## Overview
This event management system provides a centralized way to handle WordPress hooks (actions and filters) through an event subscriber pattern. It allows you to organize hook callbacks into dedicated subscriber classes, making your WordPress code more maintainable and testable by decoupling hook registration from business logic.

## Purpose
This system provides a robust and scalable solution for managing events within WordPress, following best practices for event-driven architecture.

## Installation

Install via Composer:

```bash
composer require wp-media/event-manager
```

## Initialization

Initialize the Event Manager in your WordPress plugin or theme:

```php
use WPMedia\EventManager\EventManager;
use WPMedia\EventManager\PluginApiManager;

$event_manager = new EventManager(new PluginApiManager());
$event_manager->add_subscriber(new YourEventSubscriber());
```

## Usage

### Creating an Event Subscriber

Implement the `SubscriberInterface` to listen to WordPress hooks:

```php
use WPMedia\EventManager\SubscriberInterface;

class YourEventSubscriber implements SubscriberInterface
{
    public static function get_subscribed_events(): array
    {
        return [
            'init' => 'on_init',
            'wp_enqueue_scripts' => ['on_enqueue_scripts', 10],
        ];
    }

    public function on_init()
    {
        // Handle init hook
    }

    public function on_enqueue_scripts()
    {
        // Handle script enqueuing
    }
}
```

## Reference
- **Original Design Article**: [Designing a System for WordPress Event Management](https://carlalexander.ca/designing-system-wordpress-event-management/)
- **Author**: Carl Alexander

## Implementation Notes
This implementation adapts the concepts from the referenced article to create a practical event management solution for WordPress applications.