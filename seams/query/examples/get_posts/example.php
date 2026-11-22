<?php
// Posts matching arguments through WP_Query, without paging or sticky posts, 5 by default; suppresses filters unless told not to.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_insert_post( array( 'post_title' => 'Draft' ) );
return array( wp_list_pluck( get_posts(), 'post_title' ), count( get_posts( array( 'post_status' => 'any' ) ) ), get_posts( array( 'fields' => 'ids' ) ) === array( $id ) );
