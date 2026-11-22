<?php
// Ajax handler for the editor's previews of [gallery], [audio], [video] and [playlist]: renders the shortcode and sends the HTML, head and scripts as JSON.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_parse_media_shortcode', array( 'post_ID' => $post, 'shortcode' => '[audio src="https://example.org/a.mp3"]', 'type' => 'audio' ) ), true );
return array( $sent['success'], str_contains( $sent['data']['body'], 'wp-audio-shortcode' ) );
