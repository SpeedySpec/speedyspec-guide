<?php
// Hooked to get_terms: post format terms' names as their translated format names.
$terms = array( (object) array( 'taxonomy' => 'post_format', 'slug' => 'post-format-video', 'name' => 'post-format-video' ) );
return _post_format_get_terms( $terms, array( 'post_format' ), array() )[0]->name;
