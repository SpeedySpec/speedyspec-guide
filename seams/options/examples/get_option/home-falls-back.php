<?php
// An empty home reads as siteurl. (update_option() won't store an empty home, so this writes the table directly.)
global $wpdb;
$wpdb->update( $wpdb->options, array( 'option_value' => '' ), array( 'option_name' => 'home' ) );
$wpdb->update( $wpdb->options, array( 'option_value' => 'http://example.org/wp' ), array( 'option_name' => 'siteurl' ) );
return get_option( 'home' );
