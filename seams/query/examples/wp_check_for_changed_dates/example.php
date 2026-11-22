<?php
// Hooked to post_updated: records a published post's old date in _wp_old_date, so old dated links redirect.
$id = wp_insert_post( array( 'post_title' => 'D', 'post_status' => 'publish', 'post_date' => '2026-01-05 10:00:00' ) );
wp_update_post( array( 'ID' => $id, 'post_date' => '2026-02-05 10:00:00' ) );
return get_post_meta( $id, '_wp_old_date' );
