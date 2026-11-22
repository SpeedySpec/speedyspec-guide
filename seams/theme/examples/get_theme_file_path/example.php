<?php
// The path of a file in the theme, the child theme's copy first; filtered by theme_file_path.
return str_replace( WP_CONTENT_DIR, '<content>', get_theme_file_path( 'inc/setup.php' ) );
