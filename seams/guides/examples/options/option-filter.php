<?php
// option_{$option} filters a stored value every time it is read; the stored value itself is unchanged.
update_option( 'guide_colour', 'blue' );
add_filter( 'option_guide_colour', fn( $value ) => strtoupper( $value ) );
global $wpdb;
$stored = $wpdb->get_var( "SELECT option_value FROM $wpdb->options WHERE option_name = 'guide_colour'" );
return array( get_option( 'guide_colour' ), $stored );
