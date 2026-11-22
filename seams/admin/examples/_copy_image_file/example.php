<?php
// Copies an attachment's image file to a new unique name in its folder, so editing doesn't change the original; gives the new path or false.
$id = guide_image_attachment( 'guide-copy', 40, 30 );
$copy = _copy_image_file( $id );
$result = array( file_exists( $copy ), basename( $copy ) !== basename( get_attached_file( $id ) ) );
unlink( $copy );
wp_delete_attachment( $id, true );
return $result;
