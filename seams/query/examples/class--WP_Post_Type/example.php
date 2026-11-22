<?php
// WP_Post_Type holds a registered post type: its arguments resolved into properties (labels, capabilities, rewrite, REST), and what registering adds and unregistering removes: supports, rewrite rules, meta boxes, taxonomies and hooks.
$type = register_post_type( 'book', array( 'public' => true, 'has_archive' => 'library', 'taxonomies' => array( 'category' ), 'show_in_rest' => true ) );
return array( get_class( $type ), $type->has_archive, $type->rewrite, is_object_in_taxonomy( 'book', 'category' ), get_class( $type->get_rest_controller() ), $type->labels->name );
