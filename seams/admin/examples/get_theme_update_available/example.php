<?php
// The notice that a theme has a new version, with its details and update links, or false.
set_site_transient( 'update_themes', (object) array( 'response' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9', 'url' => 'https://wordpress.org/themes/twentytwentyfive/', 'package' => 'https://downloads.wordpress.org/theme/twentytwentyfive.9.9.zip' ) ) ) );
return array( str_contains( get_theme_update_available( wp_get_theme( 'twentytwentyfive' ) ), 'version 9.9' ), get_theme_update_available( wp_get_theme( 'twentytwenty' ) ) );
