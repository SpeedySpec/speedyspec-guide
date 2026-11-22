<?php
// Prints the posts pagination: the newer and older posts links with arrow icons, and the page numbers.
guide_theme( 'twentytwentyone' );
for ( $i = 1; $i <= 3; $i++ ) { wp_insert_post( array( 'post_title' => "Post $i", 'post_status' => 'publish' ) ); }
$GLOBALS['wp_query'] = new WP_Query( array( 'paged' => 2, 'posts_per_page' => 1 ) );
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];
set_query_var( 'paged', 2 );
$text = trim( preg_replace( '/\s+/', ' ', wp_strip_all_tags( guide_render( 'twenty_twenty_one_the_posts_navigation' ) ) ) );
return $text;
