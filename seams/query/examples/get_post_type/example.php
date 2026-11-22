<?php
// A post's type, or false.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
return array( get_post_type( $id ), get_post_type( 999 ) );
