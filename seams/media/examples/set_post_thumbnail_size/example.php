<?php
// Registers the post-thumbnail image size, the size the_post_thumbnail() shows by default.
set_post_thumbnail_size( 800, 450, true );
return wp_get_additional_image_sizes()['post-thumbnail'];
