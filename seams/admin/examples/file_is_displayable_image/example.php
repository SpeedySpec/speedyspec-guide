<?php
// Whether a file is an image browsers display (GIF, JPEG, PNG, BMP, ICO, WebP, AVIF); filtered by file_is_displayable_image.
$id = guide_image_attachment( 'guide-display', 40, 30 );
$result = file_is_displayable_image( get_attached_file( $id ) );
wp_delete_attachment( $id, true );
return $result;
