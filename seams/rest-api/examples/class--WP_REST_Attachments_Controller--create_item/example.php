<?php
// The media controller: attachments at /wp/v2/media, uploaded from a raw body with a Content-Disposition file name or from a multipart form, then edited, post-processed or deleted like posts.
array_map( 'unlink', glob( wp_upload_dir()['path'] . '/guide-notes*.txt' ) );
$request = new WP_REST_Request( 'POST', '/wp/v2/media' );
$request->set_header( 'Content-Type', 'text/plain' );
$request->set_header( 'Content-Disposition', 'attachment; filename="guide-notes.txt"' );
$request->set_body( 'hello file' );
add_filter( 'upload_mimes', fn( $m ) => $m + array( 'txt' => 'text/plain' ) );
$response = rest_get_server()->dispatch( $request );
$data = $response->get_data();
$result = array( $response->get_status(), $data['mime_type'], $data['media_type'], $data['title']['raw'], file_get_contents( get_attached_file( $data['id'] ) ) );
wp_delete_attachment( $data['id'], true );
return $result;
