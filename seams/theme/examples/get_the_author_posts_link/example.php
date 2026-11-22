<?php
// A link to the post author's archive; filtered by the_author_posts_link.
$id = wp_insert_post( array( 'post_title' => 'By admin', 'post_status' => 'publish', 'post_author' => 1 ) );
guide_go( "/?p=$id" );
the_post();
return get_the_author_posts_link();
