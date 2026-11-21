<?php
// With a callback, the deprecation is reported, then the filter runs.
if ( ! function_exists( '_deprecated_hook' ) ) {
	// WordPress defines this in functions.php; the example loads plugin.php only.
	function _deprecated_hook( $hook, $version, $replacement = '', $message = '' ) {
		echo "deprecated: $hook";
	}
}
add_filter( 'guide_old', fn( $v ) => $v . '!' );

return apply_filters_deprecated( 'guide_old', array( 'value' ), '6.0.0', 'guide_new' );
