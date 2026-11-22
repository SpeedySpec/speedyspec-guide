<?php
// Whether the main query has posts left to loop over; at the end it fires loop_end and rewinds.
wp_insert_post( array( 'post_title' => 'One', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'Two', 'post_status' => 'publish' ) );
guide_go( '/' );
$titles = array();
while ( have_posts() ) {
	the_post();
	$titles[] = get_the_title();
}
return array( $titles, have_posts(), did_action( 'loop_end' ) );
