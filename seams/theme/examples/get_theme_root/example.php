<?php
// The path of the folder a theme is in, wp-content/themes by default; filtered by theme_root.
return str_replace( WP_CONTENT_DIR, '<content>', get_theme_root( 'twentytwentyfive' ) );
