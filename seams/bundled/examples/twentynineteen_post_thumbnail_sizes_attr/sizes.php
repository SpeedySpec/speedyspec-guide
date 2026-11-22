<?php
// Gives featured images in lists the theme's sizes attribute; single posts and the admin are left alone. On wp_get_attachment_image_attributes.
guide_theme( 'twentynineteen' );
$GLOBALS['wp_query'] = new WP_Query();
return array_keys( twentynineteen_post_thumbnail_sizes_attr( array( 'src' => 'a.jpg' ) ) );
