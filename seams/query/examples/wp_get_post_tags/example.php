<?php
// A post's tags, as term objects by default.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_set_post_tags( $id, 'red, blue' );
return wp_get_post_tags( $id, array( 'fields' => 'names' ) );
