<?php
// A taxonomy's labels: its own over the defaults for hierarchical or flat taxonomies, named from its label; taxonomy_labels_{$taxonomy} filters them.
register_taxonomy( 'genre', 'post', array( 'label' => 'Genres', 'hierarchical' => true, 'public' => true ) );
$labels = get_taxonomy_labels( get_taxonomy( 'genre' ) );
return array( $labels->name, $labels->singular_name, $labels->add_new_item, get_taxonomy_labels( get_taxonomy( 'post_tag' ) )->add_new_item );
