<?php
// Whether the main query is for a feed, optionally of given types.
guide_go( '/?feed=rss2' );
return array( is_feed(), is_feed( 'rss2' ), is_feed( 'atom' ) );
