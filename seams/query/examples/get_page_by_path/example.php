<?php
// A page (or post of other types) by its path of slugs, like parent/child; null when none matches.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_name' => 'team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return array( get_page_by_path( 'about/team' )->post_title, get_page_by_path( 'team' ), get_page_by_path( 'nope' ) );
