<?php
// The sizes attribute value of an attachment's image at a size.
$id = guide_attachment();
return wp_get_attachment_image_sizes( $id, 'medium' );
