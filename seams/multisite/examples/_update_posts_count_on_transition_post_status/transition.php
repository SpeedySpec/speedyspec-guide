<?php
// Updates the site's post count when a post moves into or out of publish.
$post = wp_insert_post( array( 'post_title' => 'Hi', 'post_status' => 'draft' ) );
$draft = (int) get_option( 'post_count' );
wp_publish_post( $post );
return array( $draft, (int) get_option( 'post_count' ) );
