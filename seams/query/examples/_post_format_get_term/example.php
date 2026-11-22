<?php
// Hooked to get_post_format: a post format term's name as its translated format name.
$term = (object) array( 'taxonomy' => 'post_format', 'slug' => 'post-format-gallery', 'name' => 'post-format-gallery' );
return _post_format_get_term( $term )->name;
