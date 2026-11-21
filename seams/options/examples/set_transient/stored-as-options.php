<?php
// Without a persistent object cache, a transient is an option, plus a timeout option when it expires.
set_transient( 'guide_forever', 'v' );
set_transient( 'guide_minute', 'v', 60 );
global $wpdb;
return $wpdb->get_results( "SELECT option_name, autoload FROM $wpdb->options WHERE option_name LIKE '\\_transient%' ORDER BY option_name", ARRAY_A );
