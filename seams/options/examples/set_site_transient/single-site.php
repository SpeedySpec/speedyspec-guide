<?php
// On a single site a site transient is stored as options.
set_site_transient( 'guide_t', 'v', 60 );
global $wpdb;
return $wpdb->get_col( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '\\_site\\_transient%' ORDER BY option_name" );
