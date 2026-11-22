<?php
// A theme by stylesheet, the active theme by default; a WP_Theme even when it doesn't exist, with its errors.
$theme = wp_get_theme( 'twentytwentyfive' );
return array( $theme->get( 'Name' ), $theme->exists(), wp_get_theme()->get_stylesheet(), wp_get_theme()->errors()->get_error_code() );
