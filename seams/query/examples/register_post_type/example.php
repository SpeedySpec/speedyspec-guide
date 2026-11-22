<?php
// Registers a post type with its labels, visibility, capabilities, supports, taxonomies, rewrite and REST settings; fires registered_post_type; an error for invalid names.
$type = register_post_type( 'book', array( 'label' => 'Books', 'public' => true, 'has_archive' => true, 'supports' => array( 'title', 'thumbnail' ), 'show_in_rest' => true ) );
return array( $type->label, $type->rest_base, post_type_supports( 'book', 'editor' ), post_type_supports( 'book', 'thumbnail' ), $type->cap->edit_posts, register_post_type( str_repeat( 'x', 21 ) )->get_error_code() );
