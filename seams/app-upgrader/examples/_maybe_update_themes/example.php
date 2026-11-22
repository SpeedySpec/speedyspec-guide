<?php
// Hooked to admin_init and the themes screen: checks for theme updates when the last check is over 12 hours old.
guide_queue_http( array( array( 'themes' => array(), 'translations' => array(), 'no_update' => array() ) ) );
delete_site_transient( 'update_themes' );
_maybe_update_themes();
return is_object( get_site_transient( 'update_themes' ) );
