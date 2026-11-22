<?php
// The query's Loop: have_posts() checks for more, the_post() moves to the next and sets the global post, rewind_posts() starts over; loop_start and loop_end fire around it.
wp_insert_post( array( 'post_title' => 'A', 'post_status' => 'publish' ) );
wp_insert_post( array( 'post_title' => 'B', 'post_status' => 'publish' ) );
$q = new WP_Query( array( 'orderby' => 'title', 'order' => 'ASC' ) );
$titles = array();
while ( $q->have_posts() ) {
	$q->the_post();
	$titles[] = get_the_title();
}
$q->rewind_posts();
wp_reset_postdata();
return array( $titles, $q->current_post, did_action( 'loop_start' ), did_action( 'loop_end' ) );
