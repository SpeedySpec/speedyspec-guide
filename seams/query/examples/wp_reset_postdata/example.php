<?php
// Puts the global post back to the main query's current post after a secondary loop.
$a = wp_insert_post( array( 'post_title' => 'Main', 'post_status' => 'publish' ) );
$b = wp_insert_post( array( 'post_title' => 'Other', 'post_status' => 'publish' ) );
guide_go( "/?p=$a" );
the_post();
$other = new WP_Query( array( 'p' => $b ) );
$other->the_post();
$during = get_the_title();
wp_reset_postdata();
return array( $during, get_the_title() );
