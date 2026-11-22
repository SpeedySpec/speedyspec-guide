<?php
// Hooked to load-themes.php on a network: adds the update notice row under each theme with an update in the themes list.
set_site_transient( 'update_themes', (object) array( 'response' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9' ) ) ) );
wp_theme_update_rows();
return has_action( 'after_theme_row_twentytwentyfive', 'wp_theme_update_row' );
