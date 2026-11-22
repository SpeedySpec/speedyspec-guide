<?php
// Whether the page queried uses a page template, or one of the given ones.
$page = wp_insert_post( array( 'post_title' => 'Wide', 'post_type' => 'page', 'post_status' => 'publish', 'meta_input' => array( '_wp_page_template' => 'templates/wide.php' ) ) );
guide_go( "/?page_id=$page" );
return array( is_page_template(), is_page_template( 'templates/wide.php' ), is_page_template( 'other.php' ) );
