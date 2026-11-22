<?php
// Copies the ID3 tag values getID3 found (title, artist, album and others) into a media file's metadata.
$metadata = array();
wp_add_id3_tag_data( $metadata, array( 'id3v2' => array( 'comments' => array( 'title' => array( 'Song' ), 'artist' => array( 'Ada' ) ) ) ) );
return $metadata;
