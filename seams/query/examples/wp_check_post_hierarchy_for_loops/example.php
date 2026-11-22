<?php
// Hooked to wp_insert_post_parent: the parent to save, 0 when it would make the post its own ancestor; a loop elsewhere in the tree is broken by detaching a member.
$a = wp_insert_post( array( 'post_title' => 'A', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'B', 'post_type' => 'page', 'post_parent' => $a ) );
$c = wp_insert_post( array( 'post_title' => 'C', 'post_type' => 'page' ) );
return array( wp_check_post_hierarchy_for_loops( $b, $a ), wp_check_post_hierarchy_for_loops( $a, $a ), wp_check_post_hierarchy_for_loops( $c, $a ) === $c );
