<?php
// Adds srcset and sizes to an img tag in content when wp_img_tag_add_srcset_and_sizes_attr allows.
$id = guide_attachment();
$tag = '<img src="' . wp_get_attachment_image_url( $id, 'medium' ) . '" width="300" height="200">';
return wp_img_tag_add_srcset_and_sizes_attr( $tag, 'the_content', $id );
