<?php
// An attachment's data for the media modal: its URLs, sizes, dates, author, nonces and links; filtered by wp_prepare_attachment_for_js.
$id = guide_attachment( array( 'post_title' => 'Lake' ) );
$data = wp_prepare_attachment_for_js( $id );
return array( $data['title'], $data['type'], $data['subtype'], array_keys( $data['sizes'] ) );
