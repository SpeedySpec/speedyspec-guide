<?php
// Pages in hierarchy order, each ID with its slug.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_name' => 'a', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_name' => 'b', 'post_type' => 'page', 'post_parent' => $a ) );
return array_values( get_page_hierarchy( get_posts( array( 'post_type' => 'page', 'post_status' => 'any', 'order' => 'DESC' ) ) ) );
