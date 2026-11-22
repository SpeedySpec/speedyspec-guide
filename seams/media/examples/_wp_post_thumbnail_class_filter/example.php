<?php
// Adds wp-post-image to an image's classes; hooked while a post thumbnail renders.
return _wp_post_thumbnail_class_filter( array( 'class' => 'attachment-thumbnail' ) );
