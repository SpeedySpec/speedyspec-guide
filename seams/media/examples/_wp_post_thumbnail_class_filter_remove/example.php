<?php
// Hooked to end_fetch_post_thumbnail_html: removes the filter giving post thumbnails the wp-post-image class.
_wp_post_thumbnail_class_filter_add( array() );
_wp_post_thumbnail_class_filter_remove( array() );
return has_filter( 'wp_get_attachment_image_attributes', '_wp_post_thumbnail_class_filter' );
