<?php
// Whether the main query is for a page, optionally given ones by ID, title, slug or path.
$page = wp_insert_post( array( 'post_title' => 'About Us', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
guide_go( "/?page_id=$page" );
return array( is_page(), is_page( 'about' ), is_page( 'About Us' ), is_page( 'contact' ) );
