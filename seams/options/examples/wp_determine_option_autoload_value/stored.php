<?php
// What add_option() stores for each $autoload, ordered by name. A large value with no choice is not autoloaded.
add_option( 'guide_on', 'v', '', true );
add_option( 'guide_off', 'v', '', false );
add_option( 'guide_auto', 'v' );
add_option( 'guide_big', str_repeat( 'a', 150001 ) );
global $wpdb;
return $wpdb->get_col( "SELECT autoload FROM $wpdb->options WHERE option_name LIKE 'guide\\_%' ORDER BY option_name" );
