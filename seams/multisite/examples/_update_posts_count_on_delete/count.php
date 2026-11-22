<?php
// Updates the site's post count when a published post is deleted.
$post = wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'publish' ) );
$with = get_option( 'post_count' );
wp_delete_post( $post, true );
return array( $with, get_option( 'post_count' ) );
