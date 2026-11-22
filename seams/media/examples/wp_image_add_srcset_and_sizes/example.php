<?php
// Adds srcset and sizes to an img tag from its attachment's metadata, unless it has them.
$id = guide_attachment();
$tag = '<img src="' . wp_get_attachment_image_url( $id, 'medium' ) . '" width="300" height="200">';
return wp_image_add_srcset_and_sizes( $tag, wp_get_attachment_metadata( $id ), $id );
