<?php
// Renders the [playlist] shortcode: a player for the audio or video attachments given by ids, or attached to the post, with their data in JSON; post_playlist can replace it.
$post = wp_insert_post( array( 'post_title' => 'Album', 'post_status' => 'publish' ) );
$a = wp_insert_attachment( array( 'post_title' => 'One', 'post_mime_type' => 'audio/mpeg', 'post_parent' => $post ), 'one.mp3' );
$b = wp_insert_attachment( array( 'post_title' => 'Two', 'post_mime_type' => 'audio/mpeg', 'post_parent' => $post ), 'two.mp3' );
$html = wp_playlist_shortcode( array( 'ids' => "$a,$b" ) );
return array( str_contains( $html, 'wp-playlist wp-audio-playlist' ), substr_count( $html, '"title":' ) );
