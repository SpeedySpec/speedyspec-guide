<?php
// The srcset attribute value of an attachment's image at a size, listing the same-ratio sub-sizes.
$id = guide_attachment();
return wp_get_attachment_image_srcset( $id, 'medium' );
