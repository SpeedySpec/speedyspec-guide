<?php
// WP_Query turns query variables into SQL through wpdb (with the date, meta and tax query helpers), runs it, and keeps the posts with their counts and paging; its conditional tags and Loop describe the result.
$cat = wp_insert_term( 'News', 'category' )['term_id'];
foreach ( array( 'One', 'Two', 'Three' ) as $title ) {
	$id = wp_insert_post( array( 'post_title' => $title, 'post_status' => 'publish', 'post_category' => array( $cat ), 'meta_input' => array( 'rank' => strlen( $title ) ) ) );
}
$q = new WP_Query( array( 'cat' => $cat, 'posts_per_page' => 2, 'meta_key' => 'rank', 'orderby' => 'meta_value_num', 'order' => 'ASC' ) );
return array( wp_list_pluck( $q->posts, 'post_title' ), $q->found_posts, $q->max_num_pages, $q->is_category(), str_contains( $q->request, 'LIMIT 0, 2' ) );
