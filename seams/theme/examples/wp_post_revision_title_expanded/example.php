<?php
// A revision's title with its author's avatar and name and how long ago it was made; filtered by wp_post_revision_title_expanded.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2' ) );
$rev = current( wp_get_post_revisions( $id ) );
return str_contains( wp_post_revision_title_expanded( $rev, false ), 'Admin' );
