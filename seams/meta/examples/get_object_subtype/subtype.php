<?php
// An object's subtype for meta: a post's type, a term's taxonomy, comment and user for those; get_object_subtype_{$type} filters it.
$post = wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
$term = wp_insert_term( 'News', 'category' )['term_id'];
return array( get_object_subtype( 'post', $post ), get_object_subtype( 'term', $term ), get_object_subtype( 'user', 1 ), get_object_subtype( 'post', 999 ) );
