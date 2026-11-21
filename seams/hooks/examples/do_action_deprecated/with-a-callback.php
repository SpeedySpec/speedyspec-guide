<?php
// With a callback, the deprecation is reported, then the action runs.
if ( ! function_exists( '_deprecated_hook' ) ) {
	// WordPress defines this in functions.php; the example loads plugin.php only.
	function _deprecated_hook( $hook, $version, $replacement = '', $message = '' ) {
		echo "deprecated: $hook";
	}
}
add_action( 'guide_old_action', function () {
	echo ' ran';
} );
do_action_deprecated( 'guide_old_action', array(), '6.0.0', 'guide_new_action' );

return null;
