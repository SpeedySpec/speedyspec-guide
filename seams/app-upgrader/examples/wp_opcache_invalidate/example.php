<?php
// Clears a PHP file from OPcache after it changes, when OPcache is on; filtered by wp_opcache_invalidate_file.
return wp_opcache_invalidate( ABSPATH . 'wp-content/notes.txt' );
