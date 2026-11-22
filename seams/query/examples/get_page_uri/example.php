<?php
// A page's path of slugs from its ancestors, like parent/child; filtered by get_page_uri.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page' ) );
$b = wp_insert_post( array( 'post_title' => 'Team', 'post_name' => 'team', 'post_type' => 'page', 'post_parent' => $a ) );
return get_page_uri( $b );
