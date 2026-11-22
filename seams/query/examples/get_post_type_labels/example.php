<?php
// A post type's labels, its own over the defaults for flat or hierarchical types; filtered by post_type_labels_{$post_type}.
register_post_type( 'book', array( 'labels' => array( 'name' => 'Books', 'singular_name' => 'Book' ) ) );
$labels = get_post_type_labels( get_post_type_object( 'book' ) );
return array( $labels->name, $labels->add_new_item, $labels->menu_name );
