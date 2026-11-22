<?php
// Hooked to begin_fetch_post_thumbnail_html: adds the filter giving post thumbnails the wp-post-image class.
_wp_post_thumbnail_class_filter_add( array() );
return has_filter( 'wp_get_attachment_image_attributes', '_wp_post_thumbnail_class_filter' );
