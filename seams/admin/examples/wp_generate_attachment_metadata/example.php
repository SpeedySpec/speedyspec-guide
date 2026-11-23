<?php
// Makes an uploaded file's metadata: for images its size, the sub-sizes it creates and EXIF data; for audio and video their ID3 data; filtered by wp_generate_attachment_metadata.
$id = guide_image_attachment( 'guide-meta', 400, 300 );
$meta = wp_get_attachment_metadata( $id );
$result = array( $meta['width'], $meta['height'], array_keys( $meta['sizes'] ) );
wp_delete_attachment( $id, true );
return $result;
