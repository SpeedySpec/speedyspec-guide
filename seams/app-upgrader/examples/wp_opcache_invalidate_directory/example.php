<?php
// Clears every PHP file in a folder from OPcache, when OPcache is on, through $wp_filesystem.
WP_Filesystem();
wp_opcache_invalidate_directory( WP_PLUGIN_DIR );
return true;
