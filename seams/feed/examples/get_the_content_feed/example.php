<?php
// The current post's content for a feed of a type, filtered by the_content and the_content_feed, with ]]> made safe.
$id = wp_insert_post( array( 'post_title' => 'Sencha', 'post_status' => 'publish', 'post_content' => 'Steep it for **two** minutes ]]> no more.' ) );
guide_go( "/?p=$id&feed=rss2" );
the_post();
return get_the_content_feed( 'rss2' );
