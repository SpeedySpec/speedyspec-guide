<?php
// The path of a file in the parent theme; filtered by parent_theme_file_path.
return str_replace( WP_CONTENT_DIR, '<content>', get_parent_theme_file_path( 'functions.php' ) );
