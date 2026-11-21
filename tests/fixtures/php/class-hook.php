<?php
final class WP_Hook implements ArrayAccess {
	public $callbacks = array();

	public function add_filter( $hook_name, $callback, $priority, $accepted_args ) {
		$this->callbacks[ $priority ][] = $callback;
	}

	public function apply_filters( $value, $args ) {
		return $value;
	}

	public static function build_preinitialized_hooks( $filters ) {
		return array();
	}
}
