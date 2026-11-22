<?php
// Renames trashed posts that hold a slug a new post wants, adding __trashed; wp_insert_post() calls it.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_trash_post( $id );
wp_add_trashed_suffix_to_post_name_for_trashed_posts( 'hello' );
return get_post( $id )->post_name;
