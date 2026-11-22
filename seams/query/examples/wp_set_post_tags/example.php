<?php
// Sets a post's tags, from names or a comma-separated list, replacing or appending.
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish', 'post_content' => 'Body' ) );
wp_set_post_tags( $id, 'red, blue' );
wp_set_post_tags( $id, 'green' );
return wp_get_post_tags( $id, array( 'fields' => 'names' ) );
