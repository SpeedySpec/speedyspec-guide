<?php
// Prints the fields of an audio or video attachment's ID3 data, such as artist and album, on its edit screen.
$id = wp_insert_attachment( array( 'post_title' => 'Song', 'post_mime_type' => 'audio/mpeg' ), 'song.mp3' );
wp_update_attachment_metadata( $id, array( 'artist' => 'Ada', 'album' => 'Teatime' ) );
$html = guide_render( fn() => attachment_id3_data_meta_box( get_post( $id ) ) );
return array( str_contains( $html, 'value="Ada"' ), str_contains( $html, 'value="Teatime"' ) );
