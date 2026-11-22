<?php
// Loads the feed the query asks for, by firing do_feed_{feed} (rss2 for the default feed); stops with an error page when nothing serves that feed.
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', fn( $comments, $feed ) => print( "do_feed_rss2 for $feed\n" ), 10, 2 );
wp( array( 'feed' => 'feed' ) );
do_feed();
return guide_dies( function () { set_query_var( 'feed', 'nope' ); do_feed(); } )['message'];
