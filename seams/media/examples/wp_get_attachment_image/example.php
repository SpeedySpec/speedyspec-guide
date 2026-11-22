<?php
// The img tag of an attachment's image at a size, with alt, srcset, sizes, loading and decoding; filtered by wp_get_attachment_image_attributes and wp_get_attachment_image.
$id = guide_attachment();
update_post_meta( $id, '_wp_attachment_image_alt', 'A lake' );
return wp_get_attachment_image( $id, 'medium' );
