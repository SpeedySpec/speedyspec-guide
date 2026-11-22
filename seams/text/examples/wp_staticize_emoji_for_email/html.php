<?php
// Only an HTML message gets images: the content type comes from the headers, then wp_mail_content_type.
$html = wp_staticize_emoji_for_email( array( 'message' => '🙂', 'headers' => array( 'Content-Type: text/html; charset=UTF-8' ) ) );
$plain = wp_staticize_emoji_for_email( array( 'message' => '🙂', 'headers' => '' ) );
add_filter( 'wp_mail_content_type', fn() => 'text/html' );
$filtered = wp_staticize_emoji_for_email( array( 'message' => 'x 🙂' ) );
return array( $html['message'], $plain['message'], $filtered['message'] );
