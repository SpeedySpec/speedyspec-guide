<?php
// The ID of a category with a name, under a parent when given, or null.
$green = wp_insert_term( 'Green', 'category' );
return array( (int) category_exists( 'Green' ) === $green['term_id'], category_exists( 'Purple' ) );
