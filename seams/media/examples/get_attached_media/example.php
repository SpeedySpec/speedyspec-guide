<?php
// The attachments of a post, of a MIME type such as image or audio, in menu order; filtered by get_attached_media.
$post = wp_insert_post( array( 'post_title' => 'Trip', 'post_status' => 'publish' ) );
guide_attachment( array( 'post_parent' => $post, 'post_title' => 'Lake' ) );
wp_insert_attachment( array( 'post_title' => 'Song', 'post_mime_type' => 'audio/mpeg', 'post_parent' => $post ), 'song.mp3' );
return array( wp_list_pluck( get_attached_media( 'image', $post ), 'post_title' ), wp_list_pluck( get_attached_media( 'audio', $post ), 'post_title' ) );
