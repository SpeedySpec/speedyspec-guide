<?php
// Searches the theme folders for themes (a style.css one or two levels deep), by stylesheet with their file and root; cached.
$found = search_theme_directories();
return array( $found['twentytwentyfive']['theme_file'], str_replace( WP_CONTENT_DIR, '<content>', $found['twentytwentyfive']['theme_root'] ) );
