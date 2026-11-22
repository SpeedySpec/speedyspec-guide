<?php
// The labels of the ID3 metadata WordPress shows for audio and video attachments, by key; filtered by wp_get_attachment_id3_keys.
$id = wp_insert_attachment( array( 'post_title' => 'Song', 'post_mime_type' => 'audio/mpeg' ), 'song.mp3' );
return array( wp_get_attachment_id3_keys( get_post( $id ) ), array_keys( wp_get_attachment_id3_keys( get_post( $id ), 'js' ) ) );
