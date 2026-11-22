<?php
// Whether the active theme (or its parent) has a theme.json; cached unless the theme is being developed.
$none = wp_theme_has_theme_json();
wp_clean_theme_json_cache();
guide_theme( 'twentytwentyfive' );
return array( $none, wp_theme_has_theme_json() );
