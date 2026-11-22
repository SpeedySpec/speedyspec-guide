<?php
// Updates the site's last_updated when a public post is published.
wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish' ) );
return get_site()->last_updated !== '2026-03-01 09:00:00';
