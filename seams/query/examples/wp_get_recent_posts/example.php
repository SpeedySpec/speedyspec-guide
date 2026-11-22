<?php
// The latest posts as arrays (or objects), 10 by default, published, draft, pending, future and private.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array_column( wp_get_recent_posts( array( 'numberposts' => 1 ) ), 'post_title' );
