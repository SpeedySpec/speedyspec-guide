<?php
// How many revisions to keep for a post: WP_POST_REVISIONS (-1, all, by default), 0 when the type doesn't support them; filtered by wp_revisions_to_keep and wp_{$post_type}_revisions_to_keep.
$post = get_post( wp_insert_post( array( 'post_title' => 'x' ) ) );
$all = wp_revisions_to_keep( $post );
add_filter( 'wp_post_revisions_to_keep', 'guide_keep_five' );
function guide_keep_five() {
	return 5;
}
return array( $all, wp_revisions_to_keep( $post ) );
