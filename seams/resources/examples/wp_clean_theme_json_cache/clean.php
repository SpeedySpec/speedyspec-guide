<?php
// Clears the caches of the merged theme.json data, the stylesheet and the theme.json check.
guide_theme( 'twentytwentyfive' );
wp_get_global_stylesheet();
wp_clean_theme_json_cache();
return array( wp_cache_get( 'wp_get_global_stylesheet', 'theme_json' ), wp_cache_get( 'wp_theme_has_theme_json', 'theme_json' ) );
