<?php
// Prints (or gives) a list of pages linked, hierarchical, with the current page marked; filtered by wp_list_pages.
$a = wp_insert_post( array( 'post_title' => 'About', 'post_type' => 'page', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Team', 'post_type' => 'page', 'post_status' => 'publish', 'post_parent' => $a ) );
return wp_list_pages( array( 'echo' => 0, 'title_li' => '' ) );
