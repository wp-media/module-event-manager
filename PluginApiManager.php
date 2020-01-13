<?php
/**
 * Based on https://carlalexander.ca/designing-system-wordpress-event-management/
 *
 * @package WPMedia\EventManager
 */

namespace WPMedia\EventManager;

/**
 * Wrapper class around the WordPress plugin API
 */
class PluginApiManager
{
    /**
     * Adds a callback to a specific hook of the WordPress plugin API.
     *
     * @uses add_filter()
     *
     * @param string   $hook_name     Name of the hook.
     * @param callable $callback      Callback function.
     * @param int      $priority      Priority.
     * @param int      $accepted_args Number of arguments.
     */
    public function addCallback($hook_name, $callback, $priority = 10, $accepted_args = 1)
    {
        add_filter($hook_name, $callback, $priority, $accepted_args);
    }

    /**
     * Removes the given callback from the given hook. The WordPress plugin API only
     * removes the hook if the callback and priority match a registered hook.
     *
     * @uses remove_filter()
     *
     * @param string   $hook_name Hook name.
     * @param callable $callback  Callback.
     * @param int      $priority  Priority.
     *
     * @return bool
     */
    public function removeCallback($hook_name, $callback, $priority = 10)
    {
        return remove_filter($hook_name, $callback, $priority);
    }

    /**
     * Checks the WordPress plugin API to see if the given hook has
     * the given callback. The priority of the callback will be returned
     * or false. If no callback is given will return true or false if
     * there's any callbacks registered to the hook.
     *
     * @uses has_filter()
     *
     * @param string $hook_name Hook name.
     * @param mixed  $callback  Callback.
     *
     * @return bool|int
     */
    public function hasCallback($hook_name, $callback = false)
    {
        return has_filter($hook_name, $callback);
    }

    /**
     * Get the name of the hook that WordPress plugin API is executing. Returns
     * false if it isn't executing a hook.
     *
     * @uses current_filter()
     *
     * @return string|bool
     */
    public function getCurrentHook()
    {
        return current_filter();
    }

    /**
     * Executes all the callbacks registered with the given hook.
     *
     * @uses do_action()
     */
    public function execute()
    {
        $args = func_get_args();
        return call_user_func_array('do_action', $args);
    }
 
    /**
     * Filters the given value by applying all the changes from the callbacks
     * registered with the given hook. Returns the filtered value.
     *
     * @uses apply_filters()
     *
     * @return mixed
     */
    public function filter()
    {
        $args = func_get_args();
        return call_user_func_array('apply_filters', $args);
    }
}
