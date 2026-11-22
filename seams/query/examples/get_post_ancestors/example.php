<?php
// A post's ancestors' IDs, nearest first, guarding against loops.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
$c = wp_insert_post( array( 'post_title' => 'C', 'post_type' => 'page', 'post_parent' => $b ) );
return get_post_ancestors( $c ) === array( $b, $a );
