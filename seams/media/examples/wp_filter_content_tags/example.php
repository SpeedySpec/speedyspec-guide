<?php
// Adds srcset, sizes, width, height, loading and decoding to the img and iframe tags of content, from their attachments; hooked to the_content.
$id = guide_attachment();
$content = '<p><img class="wp-image-' . $id . '" src="' . wp_get_attachment_image_url( $id, 'medium' ) . '"></p>';
return wp_filter_content_tags( $content, 'the_content' );
