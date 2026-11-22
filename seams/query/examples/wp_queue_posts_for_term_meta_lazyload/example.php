<?php
// Queues the terms of posts for term meta to load together the first time any is read.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_queue_posts_for_term_meta_lazyload( array( get_post( $id ) ) );
return 'queued';
