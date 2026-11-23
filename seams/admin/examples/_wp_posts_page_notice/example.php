<?php
// Prints the classic editor's notice that the page being edited is the posts page, so its content isn't shown.
$page = wp_insert_post( array( 'post_type' => 'page', 'post_title' => 'Blog', 'post_status' => 'publish' ) );
update_option( 'page_for_posts', $page );
$GLOBALS['post'] = get_post( $page );
set_current_screen( 'page' );
return str_contains( guide_render( '_wp_posts_page_notice' ), 'currently editing the page that shows your latest posts' );
