<?php
// Prints (or gives) the links to a post's pages split by the nextpage tag, numbered or next and previous; filtered by wp_link_pages_args and wp_link_pages.
$id = wp_insert_post( array( 'post_title' => 'Long', 'post_status' => 'publish', 'post_content' => 'one<!--nextpage-->two<!--nextpage-->three' ) );
guide_go( "/?p=$id&page=2" );
the_post();
return wp_link_pages( array( 'echo' => 0 ) );
