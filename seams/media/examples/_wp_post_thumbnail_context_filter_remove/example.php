<?php
// Hooked to end_fetch_post_thumbnail_html: removes the filter giving post thumbnails the_post_thumbnail context.
_wp_post_thumbnail_context_filter_add();
_wp_post_thumbnail_context_filter_remove();
return has_filter( 'wp_get_attachment_image_context', '_wp_post_thumbnail_context_filter' );
