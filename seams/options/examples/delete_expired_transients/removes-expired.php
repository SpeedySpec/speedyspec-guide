<?php
// Deletes expired transients and their timeouts from the table, and keeps the rest.
set_transient( 'guide_old', 'v', 60 );
set_transient( 'guide_new', 'v', 60 );
update_option( '_transient_timeout_guide_old', time() - 1 );
delete_expired_transients();
global $wpdb;
return $wpdb->get_col( "SELECT option_name FROM $wpdb->options WHERE option_name LIKE '%transient%' ORDER BY option_name" );
