<?php
// Clears the cached plugins list, and the stored plugin updates unless told not to.
get_plugins();
set_site_transient( 'update_plugins', (object) array( 'response' => array() ) );
wp_clean_plugins_cache();
return array( wp_cache_get( 'plugins', 'plugins' ), get_site_transient( 'update_plugins' ) );
