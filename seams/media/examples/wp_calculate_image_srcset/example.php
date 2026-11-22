<?php
// The srcset value for an image source from its metadata: the same-ratio sizes up to max_srcset_image_width, or false; filtered by wp_calculate_image_srcset.
$id = guide_attachment();
$meta = wp_get_attachment_metadata( $id );
return wp_calculate_image_srcset( array( 1024, 683 ), wp_get_attachment_image_url( $id, 'large' ), $meta, $id );
