<?php
// Stores an attachment's file path in _wp_attached_file, relative to the uploads folder; filtered by update_attached_file.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
update_attached_file( $att, wp_upload_dir()['basedir'] . '/2026/02/new.jpg' );
return get_post_meta( $att, '_wp_attached_file', true );
