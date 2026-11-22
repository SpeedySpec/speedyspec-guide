<?php
// The alternative text an image file carries in its metadata (IPTC or XMP), or an empty string.
$id = guide_image_attachment( 'guide-alt', 40, 30 );
$alt = wp_get_image_alttext( get_attached_file( $id ) );
wp_delete_attachment( $id, true );
return $alt;
