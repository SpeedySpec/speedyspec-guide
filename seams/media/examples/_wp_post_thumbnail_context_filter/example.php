<?php
// Gives the_post_thumbnail as the context of an image while a post thumbnail renders.
return _wp_post_thumbnail_context_filter( 'wp_get_attachment_image' );
