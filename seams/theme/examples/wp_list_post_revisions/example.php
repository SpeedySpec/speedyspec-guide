<?php
// Prints a post's revisions as a list, all or only revisions or autosaves.
$id = wp_insert_post( array( 'post_title' => 'v1', 'post_status' => 'publish' ) );
wp_update_post( array( 'ID' => $id, 'post_title' => 'v2' ) );
$rev = current( wp_get_post_revisions( $id ) );
return substr_count( guide_render( fn() => wp_list_post_revisions( $id ) ), '<li' );
