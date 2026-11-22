<?php
// Hooked to admin_init: checks for core updates when the last check is over 12 hours old or was for another version.
guide_queue_http( array( array( 'offers' => array(), 'translations' => array() ) ) );
delete_site_transient( 'update_core' );
_maybe_update_core();
return is_object( get_site_transient( 'update_core' ) );
