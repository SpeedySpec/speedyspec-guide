<?php
// A tag cloud from terms: each sized between the smallest and largest by count, ordered and formatted as flat, list or array; filtered by wp_generate_tag_cloud and wp_generate_tag_cloud_data.
$terms = array( (object) array( 'term_id' => 1, 'name' => 'Big', 'slug' => 'big', 'count' => 10, 'link' => '/big' ), (object) array( 'term_id' => 2, 'name' => 'Small', 'slug' => 'small', 'count' => 1, 'link' => '/small' ) );
return wp_generate_tag_cloud( $terms, array( 'format' => 'flat', 'smallest' => 8, 'largest' => 22, 'unit' => 'px' ) );
