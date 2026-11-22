<?php
// Whether the main query is for the blog home: the front page when it shows posts, or the posts page.
guide_go( '/' );
$front = is_home();
$blog = wp_insert_post( array( 'post_title' => 'Blog', 'post_type' => 'page', 'post_status' => 'publish' ) );
update_option( 'show_on_front', 'page' );
update_option( 'page_for_posts', $blog );
guide_go( "/?page_id=$blog" );
return array( $front, is_home(), is_page() );
