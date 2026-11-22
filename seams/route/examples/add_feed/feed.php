<?php
// Adds a feed type and hooks its callback to do_feed_{name}, replacing WordPress's own for that name.
$hook = add_feed( 'guide', fn() => print( 'feed' ) );
add_feed( 'guide', 'strtoupper' );
return array( $hook, array_slice( $GLOBALS['wp_rewrite']->feeds, -1 ), has_action( 'do_feed_guide', 'strtoupper' ) );
