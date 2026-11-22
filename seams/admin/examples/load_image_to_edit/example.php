<?php
// Opens an attachment's image file, or a size of it, as a GD image for editing, or false.
$id = guide_image_attachment( 'guide-load', 40, 30 );
$image = load_image_to_edit( $id, 'image/png' );
$result = array( is_gd_image( $image ), imagesx( $image ) );
wp_delete_attachment( $id, true );
return $result;
