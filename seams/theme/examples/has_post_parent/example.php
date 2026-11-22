<?php
// Whether a post has a parent.
$a = wp_insert_post( array( 'post_title' => 'Parent', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'Child', 'post_type' => 'page', 'post_parent' => $a ) );
return array( has_post_parent( $b ), has_post_parent( $a ) );
