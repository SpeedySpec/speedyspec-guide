<?php
// A taxonomy's properties from its arguments over the defaults: public flags, UI, capabilities, rewrite (filled in only with pretty permalinks or in the admin; here plain permalinks leave it as given), query var, REST settings; register_taxonomy_args and register_{$taxonomy}_taxonomy_args filter them.
add_filter( 'register_taxonomy_args', fn( $args, $name ) => 'genre' === $name ? $args + array( 'description' => 'Kinds' ) : $args, 10, 2 );
$tax = new WP_Taxonomy( 'genre', 'post', array( 'public' => true, 'hierarchical' => true, 'show_in_rest' => true ) );
return array( $tax->description, $tax->publicly_queryable, $tax->show_ui, $tax->query_var, $tax->rewrite, $tax->rest_base, $tax->cap->manage_terms, $tax->object_type );
