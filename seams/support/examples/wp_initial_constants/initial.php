<?php
// Defines the constants WordPress needs first, unless wp-config.php did: memory limits, WP_CONTENT_DIR, debugging, cache, the time units and the KB_IN_BYTES family, and sets the blog_id global.
wp_initial_constants();
return array( WP_MEMORY_LIMIT, WP_MAX_MEMORY_LIMIT, str_replace( ABSPATH, '', WP_CONTENT_DIR ), WP_DEBUG_LOG, WP_CACHE, MB_IN_BYTES, WEEK_IN_SECONDS );
