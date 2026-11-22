<?php
// A custom field's row by its meta ID, with the value unserialized, or false.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$id = add_post_meta( $post, 'origin', 'Fujian' );
$meta = get_post_meta_by_id( $id );
return array( $meta->meta_key, $meta->meta_value );
