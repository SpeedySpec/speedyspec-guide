<?php
// The installed themes as WP_Theme objects keyed by stylesheet, filtered by errors, allowed status and blog; cached per request.
$themes = wp_get_themes();
return array( isset( $themes['twentytwentyfive'] ), $themes['twentytwentyfive']->get( 'Name' ) );
