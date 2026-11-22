<?php
// An attachment's file path from _wp_attached_file, made absolute under the uploads folder; filtered by get_attached_file; raw with unfiltered.
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg', 'guid' => 'http://example.org/wp-content/uploads/2026/01/pic.jpg' ), '2026/01/pic.jpg' );
return array( str_replace( wp_upload_dir()['basedir'], '<uploads>', get_attached_file( $att ) ), get_attached_file( $att, true ) === get_attached_file( $att ) );
