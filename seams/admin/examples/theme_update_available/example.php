<?php
// Prints the notice that a theme has a new version, with its details and update links.
set_site_transient( 'update_themes', (object) array( 'response' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9', 'url' => 'https://wordpress.org/themes/twentytwentyfive/', 'package' => 'https://downloads.wordpress.org/theme/twentytwentyfive.9.9.zip' ) ) ) );
return str_contains( guide_render( fn() => theme_update_available( wp_get_theme( 'twentytwentyfive' ) ) ), 'version 9.9' );
