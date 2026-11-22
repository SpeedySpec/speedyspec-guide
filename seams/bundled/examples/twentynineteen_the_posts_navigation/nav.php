<?php
// Prints the posts pagination with chevron icons, Newer and Older posts named by the query's order.
guide_theme( 'twentynineteen' );
for ( $i = 1; $i <= 3; $i++ ) { wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish' ) ); }
$GLOBALS['wp_query'] = new WP_Query( array( 'paged' => 2, 'posts_per_page' => 1 ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
set_query_var( 'paged', 2 );
return trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( guide_render( 'twentynineteen_the_posts_navigation' ) ) ) );
