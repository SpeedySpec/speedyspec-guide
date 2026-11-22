<?php
// A post's oEmbed data: provider, author and title, width clamped to oembed_min_max_width (200 to 600); false for a post that isn't public or embeddable. oembed_response_data filters it.
$post = guide_post();
$private = guide_post( array( 'post_status' => 'private' ) );
add_filter( 'oembed_response_data', 'get_oembed_response_data_rich', 10, 4 );
function guide_secret_password( $password ) {
	return 'SECRET';
}
add_filter( 'random_password', 'guide_secret_password' );
$data = get_oembed_response_data( $post, 9999 );
return array( $data['width'], $data['height'], $data['type'], $data['title'], get_oembed_response_data( $private, 600 ) );
