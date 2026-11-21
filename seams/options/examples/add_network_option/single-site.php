<?php
// On a single site it adds an option that isn't autoloaded.
add_network_option( null, 'guide_net', 'v' );
global $wpdb;
return $wpdb->get_var( "SELECT autoload FROM $wpdb->options WHERE option_name = 'guide_net'" );
