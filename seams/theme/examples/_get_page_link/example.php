<?php
// A page's permalink without the front page check; filtered by _get_page_link.
$page = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
return _get_page_link( $page );
