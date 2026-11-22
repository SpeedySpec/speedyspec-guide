<?php
// For embeds from sites that aren't known providers (found by discovery), keeps only a blockquote and an iframe, sandboxes the iframe and pairs them with a secret; without an iframe it gives false. Known providers' HTML is kept.
function guide_secret_password( $password ) {
	return 'SECRET';
}
add_filter( 'random_password', 'guide_secret_password' );
$data = (object) array( 'type' => 'rich' );
$discovered = wp_filter_oembed_result( '<blockquote><a href="https://blog.example/p">Post</a></blockquote><script>evil()</script><iframe src="https://blog.example/p/embed/" onload="x()"></iframe>', $data, 'https://blog.example/p' );
return array( $discovered, wp_filter_oembed_result( '<p>No frame</p>', $data, 'https://blog.example/p' ), wp_filter_oembed_result( '<iframe src="https://www.youtube.com/embed/a"></iframe>', $data, 'https://www.youtube.com/watch?v=a' ) );
