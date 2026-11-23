<?php
// Deletes a custom field by its meta ID.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$id = add_post_meta( $post, 'origin', 'Fujian' );
return array( delete_meta( $id ), get_post_meta( $post, 'origin', true ) );
