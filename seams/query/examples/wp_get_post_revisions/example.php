<?php
// A post's revisions, newest first, keyed by ID, as get_children() finds them; none when revisions are off.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish', 'post_content' => 'one' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2', 'post_content' => 'two' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v3' ) );

return array_values( wp_list_pluck( wp_get_post_revisions( $id ), 'post_title' ) );
