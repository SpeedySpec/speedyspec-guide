<?php
// Only an HTML message gets images: the content type comes from the headers, then wp_mail_content_type.
$html = wp_staticize_emoji_for_email( array( 'message' => '🙂', 'headers' => array( 'Content-Type: text/html; charset=UTF-8' ) ) );
$plain = wp_staticize_emoji_for_email( array( 'message' => '🙂', 'headers' => '' ) );
function guide_html_content_type( $content_type ) {
	return 'text/html';
}
add_filter( 'wp_mail_content_type', 'guide_html_content_type' );
$filtered = wp_staticize_emoji_for_email( array( 'message' => 'x 🙂' ) );
return array( $html['message'], $plain['message'], $filtered['message'] );
