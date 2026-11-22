<?php
// The URL, width, height and whether it is a sub-size of an attachment's image at a size, or false; filtered by wp_get_attachment_image_src.
$id = guide_attachment();
return array( wp_get_attachment_image_src( $id, 'thumbnail' ), wp_get_attachment_image_src( 999 ) );
