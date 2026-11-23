<?php
// A post's custom fields as rows of key, value, meta ID and post ID, for the Custom Fields box.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
add_post_meta( $post, 'origin', 'Fujian' );
return wp_list_pluck( has_meta( $post ), 'meta_value', 'meta_key' );
