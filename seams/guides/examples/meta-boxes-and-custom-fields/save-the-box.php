<?php
// Save the box on save_post: check the nonce, skip autosaves, check the capability, then sanitize and store.
function my_plugin_save_rating( $post_id ) {
	if ( ! isset( $_POST['my_plugin_rating_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['my_plugin_rating_nonce'] ) ), 'my_plugin_save_rating' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) || ! isset( $_POST['my_plugin_rating'] ) ) {
		return;
	}
	$rating = min( 5, absint( wp_unslash( $_POST['my_plugin_rating'] ) ) );
	update_post_meta( $post_id, 'my_plugin_rating', $rating );
}
add_action( 'save_post_post', 'my_plugin_save_rating' ); // Only for posts.

$post_id = wp_insert_post( array( 'post_title' => 'Dune', 'post_status' => 'publish' ) );

function guide_submit_rating( $post_id, $rating, $nonce ) {
	$_POST = array( 'my_plugin_rating' => $rating, 'my_plugin_rating_nonce' => $nonce );
	wp_update_post( array( 'ID' => $post_id ) ); // Saving the post fires save_post_post.
	$_POST = array();
	return get_post_meta( $post_id, 'my_plugin_rating', true );
}

$good = guide_submit_rating( $post_id, '9', wp_create_nonce( 'my_plugin_save_rating' ) );
$forged = guide_submit_rating( $post_id, '1', 'not-a-nonce' );

$subscriber = wp_insert_user( array( 'user_login' => 'sam', 'user_pass' => wp_generate_password(), 'role' => 'subscriber' ) );
wp_set_current_user( $subscriber );
$not_allowed = guide_submit_rating( $post_id, '2', wp_create_nonce( 'my_plugin_save_rating' ) );
return array(
	'asked for 9: saved, capped at 5' => $good,
	'a forged form asking for 1'       => $forged,
	'a subscriber asking for 2'        => $not_allowed,
);
