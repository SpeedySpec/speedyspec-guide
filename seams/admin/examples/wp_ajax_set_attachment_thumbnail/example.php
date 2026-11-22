<?php
// Ajax handler that sets the poster image of audio or video attachments in the media modal.
$audio = wp_insert_attachment( array( 'post_title' => 'Song', 'post_mime_type' => 'audio/mpeg' ), '2026/11/song.mp3' );
$cover = wp_insert_attachment( array( 'post_title' => 'Cover', 'post_mime_type' => 'image/jpeg' ), '2026/11/cover.jpg' );
guide_ajax( 'wp_ajax_set_attachment_thumbnail', array( 'urls' => array( wp_get_attachment_url( $audio ) ), 'thumbnail_id' => $cover ), 'set-attachment-thumbnail' );
return get_post_thumbnail_id( $audio ) === $cover;
