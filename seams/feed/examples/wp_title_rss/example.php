<?php
// Prints the feed's title; filtered by wp_title_rss.
update_option( 'blogname', 'Tea Notes' );
guide_go( '/?feed=rss2' );
return guide_render( 'wp_title_rss' );
