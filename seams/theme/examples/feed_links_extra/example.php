<?php
// Hooked to wp_head: prints the feed link tag of the page queried: a post's comments, a category, tag, author, search or post type.
guide_go( '/?cat=1' );
return guide_render( 'feed_links_extra' );
