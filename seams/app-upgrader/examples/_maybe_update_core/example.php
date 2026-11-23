<?php
// Hooked to admin_init: checks for core updates when the last check is over 12 hours old or was for another version.
guide_queue_http( array( array( 'offers' => array(), 'translations' => array() ) ) );
delete_site_transient( 'update_core' );
// The query string lists this server's PHP, database and extensions, so only the address is shown.
ob_start();
_maybe_update_core();
echo strtok( ob_get_clean(), '?' ), "\n";
return is_object( get_site_transient( 'update_core' ) );
