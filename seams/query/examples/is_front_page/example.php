<?php
// Whether the main query is for the front page: the home page when it shows posts, or the static front page.
$page = wp_insert_post( array( 'post_title' => 'Welcome', 'post_type' => 'page', 'post_status' => 'publish' ) );
guide_go( '/' );
$posts = is_front_page();
update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $page );
guide_go( "/?page_id=$page" );
return array( $posts, is_front_page(), is_home() );
