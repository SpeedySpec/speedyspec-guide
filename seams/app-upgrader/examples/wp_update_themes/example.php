<?php
// Asks WordPress.org for theme updates, sending the installed themes, and stores the answer in the update_themes transient, at most every 12 hours.
guide_queue_http( array( array( 'themes' => array( 'twentytwentyfive' => array( 'theme' => 'twentytwentyfive', 'new_version' => '9.9', 'package' => 'https://downloads.wordpress.org/theme/twentytwentyfive.9.9.zip' ) ), 'translations' => array(), 'no_update' => array() ) ) );
wp_update_themes();
return array_keys( get_site_transient( 'update_themes' )->response );
