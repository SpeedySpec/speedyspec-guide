<?php
// Prints the Custom Fields table row of one custom field, with its key, value, update and delete buttons.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$id = add_post_meta( $post, 'origin', 'Fujian' );
$count = 0;
$html = _list_meta_row( array( 'meta_id' => $id, 'meta_key' => 'origin', 'meta_value' => 'Fujian', 'post_id' => $post ), $count );
return array( str_contains( $html, "id='meta-$id'" ), str_contains( $html, 'Fujian' ), $count );
