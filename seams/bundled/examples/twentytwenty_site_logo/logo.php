<?php
// Prints (or gives) the site logo, or the site title linked home when there is none, in an h1 on the front page and posts page and a div elsewhere; the arguments and the markup are filtered.
guide_theme( 'twentytwenty' );
$GLOBALS['wp_query'] = new WP_Query();
$GLOBALS['wp_query']->is_home = true;
return twentytwenty_site_logo( array(), false );
