<?php
// The pattern slugs the theme's theme.json lists under patterns, which WordPress loads from the WordPress.org pattern directory.
guide_theme( 'twentytwentyfour' );
return wp_get_theme_directory_pattern_slugs();
