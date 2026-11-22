<?php
// Hooked to admin_init and the plugins screen: checks for plugin updates when the last check is over 12 hours old.
guide_queue_http( array( array( 'plugins' => array(), 'translations' => array(), 'no_update' => array() ) ) );
delete_site_transient( 'update_plugins' );
_maybe_update_plugins();
return is_object( get_site_transient( 'update_plugins' ) );
