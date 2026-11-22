<?php
// A post's parent post, or null.
$a = wp_insert_post( array( 'post_title' => 'Parent', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'Child', 'post_type' => 'page', 'post_parent' => $a ) );
return array( get_post_parent( $b )->post_title, get_post_parent( $a ) );
