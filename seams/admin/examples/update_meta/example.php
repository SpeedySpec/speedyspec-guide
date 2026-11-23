<?php
// Updates a custom field's key and value by its meta ID.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$id = add_post_meta( $post, 'origin', 'Fujian' );
update_meta( $id, 'region', 'Yunnan' );
return array( get_post_meta( $post, 'origin', true ), get_post_meta( $post, 'region', true ) );
