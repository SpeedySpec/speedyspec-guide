<?php
// Adds the custom field submitted in the Custom Fields box to a post; gives its meta ID or false.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$_POST = array( 'metakeyinput' => 'origin', 'metavalue' => 'Fujian' );
$id = add_meta( $post );
return array( is_int( $id ), get_post_meta( $post, 'origin', true ) );
