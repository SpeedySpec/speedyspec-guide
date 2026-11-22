<?php
// Hooked to wp_head: prints the site's posts and comments feed link tags when the theme supports automatic-feed-links.
add_theme_support( 'automatic-feed-links' );
return guide_render( 'feed_links' );
