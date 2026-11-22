<?php
// Deletes an attachment's file, its sizes, its original and its backup sizes from the uploads folder; false when one couldn't be deleted.
$dir = wp_upload_dir()['path'];
file_put_contents( "$dir/guide-del.jpg", 'x' );
file_put_contents( "$dir/guide-del-150x150.jpg", 'x' );
$att = wp_insert_attachment( array( 'post_title' => 'Del', 'post_mime_type' => 'image/jpeg' ), "$dir/guide-del.jpg" );
$meta = array( 'file' => _wp_relative_upload_path( "$dir/guide-del.jpg" ), 'sizes' => array( 'thumbnail' => array( 'file' => 'guide-del-150x150.jpg' ) ) );
$result = wp_delete_attachment_files( $att, $meta, array(), "$dir/guide-del.jpg" );
return array( $result, file_exists( "$dir/guide-del.jpg" ), file_exists( "$dir/guide-del-150x150.jpg" ) );
