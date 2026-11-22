<?php
// Maps a meta capability to the primitive capabilities a user needs: editing a post is edit_posts for its author, edit_others_posts for anyone else, edit_published_posts once published; unknown capabilities map to themselves. map_meta_cap filters the result.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
return array( map_meta_cap( 'edit_post', $grace, $post ), map_meta_cap( 'edit_post', 1, $post ), map_meta_cap( 'delete_user', 1, $grace ), map_meta_cap( 'manage_options', 1 ), map_meta_cap( 'edit_post', 1, 999 ) );
