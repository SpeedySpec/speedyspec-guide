<?php
// Saves a preview of the edited post, as an autosave or by updating the draft, and gives the preview URL.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'draft' ) );
$_POST = array( 'post_ID' => $post, 'post_type' => 'post', 'post_title' => 'Green tea', '_wpnonce' => wp_create_nonce( "update-post_$post" ) );
return str_contains( post_preview(), 'preview=true' );
