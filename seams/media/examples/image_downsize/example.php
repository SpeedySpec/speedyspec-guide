<?php
// The URL, width, height and whether it is a sub-size, for an attachment's image at a size; filtered by image_downsize.
$id = guide_attachment();
return array( image_downsize( $id, 'medium' ), image_downsize( $id, 'full' ) );
