<?php
// The active theme's folder path; filtered by stylesheet_directory.
switch_theme( 'twentytwentyfive' );
return str_replace( WP_CONTENT_DIR, '<content>', get_stylesheet_directory() );
