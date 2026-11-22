<?php
// Cleans every field of a term for a context, through sanitize_term_field().
$term = sanitize_term( array( 'term_id' => '5', 'name' => '<i>Hi</i>', 'slug' => 'hi', 'description' => 'D' ), 'post_tag', 'display' );
return $term;
