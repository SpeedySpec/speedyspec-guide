<?php
// Prints the link to the current post's comments for a feed; filtered by comments_link_feed.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return guide_render( 'comments_link_feed' ) === get_comments_link( $id );
