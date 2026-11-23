<?php
// Whether a file is an image PHP can read the size of.
$id = guide_image_attachment( 'guide-valid', 40, 30 );
$result = array( file_is_valid_image( get_attached_file( $id ) ), file_is_valid_image( ABSPATH . 'index.php' ) );
wp_delete_attachment( $id, true );
return $result;
