<?php
// Whether the logged-in user has a capability (meta capabilities checked against an object); false when nobody is logged in.
$grace = guide_user();
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish', 'post_author' => $grace ) );
$admin = array( current_user_can( 'manage_options' ), current_user_can( 'edit_post', $post ) );
wp_set_current_user( $grace );
$editor = array( current_user_can( 'manage_options' ), current_user_can( 'edit_post', $post ), current_user_can( 'publish_pages' ) );
wp_set_current_user( 0 );
return array( $admin, $editor, current_user_can( 'read' ) );
