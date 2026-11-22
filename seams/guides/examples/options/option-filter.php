<?php
// option_{$option} filters a stored value every time it is read; the stored value itself is unchanged.
function guide_shout_colour( $value ) {
	return strtoupper( $value );
}
add_filter( 'option_guide_colour', 'guide_shout_colour' );
update_option( 'guide_colour', 'blue' );
global $wpdb;
$stored = $wpdb->get_var( $wpdb->prepare( "SELECT option_value FROM $wpdb->options WHERE option_name = %s", 'guide_colour' ) );
return array( get_option( 'guide_colour' ), $stored );
