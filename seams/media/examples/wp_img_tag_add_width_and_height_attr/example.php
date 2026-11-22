<?php
// Adds width and height to an img tag in content that lacks them, from its attachment, when wp_img_tag_add_width_and_height_attr allows.
$id = guide_attachment();
return wp_img_tag_add_width_and_height_attr( '<img src="' . wp_get_attachment_image_url( $id, 'medium' ) . '">', 'the_content', $id );
