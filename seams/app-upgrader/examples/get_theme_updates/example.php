<?php
// The installed themes that have an update, by stylesheet, each with its update data from the update_themes transient.
set_site_transient( 'update_themes', (object) array( 'response' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9', 'package' => 'https://downloads.wordpress.org/theme/twentytwentyfive.9.9.zip' ) ) ) );
$updates = get_theme_updates();
return array( array_keys( $updates ), $updates['twentytwentyfive']->update['new_version'] );
