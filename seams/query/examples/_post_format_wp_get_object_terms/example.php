<?php
// Hooked to wp_get_object_terms: post format terms' names as their translated format names.
$terms = array( (object) array( 'taxonomy' => 'post_format', 'slug' => 'post-format-link', 'name' => 'post-format-link' ) );
return _post_format_wp_get_object_terms( $terms )[0]->name;
