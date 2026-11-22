<?php
// Whether the main query is for a comments feed.
guide_go( '/?feed=rss2&withcomments=1' );
return array( is_comment_feed(), is_feed() );
