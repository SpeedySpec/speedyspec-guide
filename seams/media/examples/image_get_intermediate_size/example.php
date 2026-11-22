<?php
// The file, size and URL of an attachment's image sub-size by name, or the closest size for a width and height, or false; filtered by image_get_intermediate_size.
$id = guide_attachment();
$medium = image_get_intermediate_size( $id, 'medium' );
return array( $medium['file'], $medium['url'], image_get_intermediate_size( $id, 'card' ) );
