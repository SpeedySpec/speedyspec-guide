<?php
// Turns a post form's submitted fields into wp_insert_post() fields: names, author, status, dates and capability checks; gives the data or an error.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$data = _wp_translate_postdata( true, array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', 'publish' => 'Publish', 'user_ID' => 1 ) );
return array( $data['ID'], $data['post_status'], $data['post_title'] );
