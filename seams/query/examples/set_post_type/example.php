<?php
// Changes a post's type directly in the database.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
set_post_type( $id, 'page' );
return get_post_type( $id );
