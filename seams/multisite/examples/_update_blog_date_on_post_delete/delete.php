<?php
// Updates the site's last_updated when a published public post is deleted.
$post = wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish' ) );
wp_update_site( 1, array( 'last_updated' => '2026-03-01 09:00:00' ) );
wp_delete_post( $post, true );
return get_site( 1 )->last_updated !== '2026-03-01 09:00:00';
