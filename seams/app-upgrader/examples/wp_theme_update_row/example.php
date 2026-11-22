<?php
// Prints the network themes list row telling that a theme has a new version, with the details and update links.
set_site_transient( 'update_themes', (object) array( 'response' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9', 'url' => 'https://wordpress.org/themes/twentytwentyfive/', 'package' => 'https://downloads.wordpress.org/theme/twentytwentyfive.9.9.zip' ) ) ) );
$html = guide_render( fn() => wp_theme_update_row( 'twentytwentyfive', wp_get_theme( 'twentytwentyfive' ) ) );
return array( str_contains( $html, 'plugin-update-tr' ), str_contains( $html, 'version 9.9' ) );
