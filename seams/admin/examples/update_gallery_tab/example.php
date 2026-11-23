<?php
// Hooked to media_upload_tabs: adds the Gallery tab with the count of images attached to the post, or removes it when there are none.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
wp_insert_attachment( array( 'post_title' => 'A', 'post_mime_type' => 'image/jpeg', 'post_parent' => $post ), 'a.jpg' );
$_REQUEST['post_id'] = $post;
return update_gallery_tab( array( 'type' => 'From Computer', 'gallery' => 'Gallery' ) );
