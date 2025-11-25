<?php
declare(strict_types=1);

namespace WPMedia\EventManager;

/**
 * Wrapper class around the WordPress plugin API
 */
class PluginApiManager {
	/**
	 * Adds a callback to a specific hook of the WordPress plugin API.
	 *
	 * @param string   $hook_name     Name of the hook.
	 * @param callable $callback      Callback function.
	 * @param int      $priority      Priority.
	 * @param int      $accepted_args Number of arguments.
	 */
	public function add_callback( $hook_name, $callback, $priority = 10, $accepted_args = 1 ): void {
		add_filter( $hook_name, $callback, $priority, $accepted_args );
	}

	/**
	 * Removes the given callback from the given hook. The WordPress plugin API only
	 * removes the hook if the callback and priority match a registered hook.
	 *
	 * @param string                $hook_name Hook name.
	 * @param callable|string|array $callback  Callback.
	 * @param int                   $priority  Priority.
	 *
	 * @return bool
	 */
	public function remove_callback( $hook_name, $callback, $priority = 10 ): bool {
		return remove_filter( $hook_name, $callback, $priority );
	}

	/**
	 * Checks the WordPress plugin API to see if the given hook has
	 * the given callback. The priority of the callback will be returned
	 * or false. If no callback is given will return true or false if
	 * there's any callbacks registered to the hook.
	 *
	 * @param string                      $hook_name Hook name.
	 * @param callable|string|array|false $callback  Callback.
	 *
	 * @return bool|int
	 */
	public function has_callback( $hook_name, $callback = false ) {
		return has_filter( $hook_name, $callback );
	}

	/**
	 * Get the name of the hook that WordPress plugin API is executing.
	 *
	 * @return string
	 */
	public function get_current_hook(): string {
		return current_filter();
	}

	/**
	 * Executes all the callbacks registered with the given hook.
	 *
	 * @return mixed
	 */
	public function execute() {
		$args = func_get_args();

		return call_user_func_array( 'do_action', $args );
	}

	/**
	 * Filters the given value by applying all the changes from the callbacks
	 * registered with the given hook. Returns the filtered value.
	 *
	 * @return mixed
	 */
	public function filter() {
		$args = func_get_args();

		return call_user_func_array( 'apply_filters', $args );
	}
}
