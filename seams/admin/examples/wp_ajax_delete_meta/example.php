<?php
// Ajax handler that deletes a custom field from the Custom Fields box, answering 1 on success.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$meta = add_post_meta( $post, 'origin', 'Fujian' );
return array( guide_ajax( 'wp_ajax_delete_meta', array( 'id' => $meta ), "delete-meta_$meta" ), get_post_meta( $post, 'origin', true ) );
