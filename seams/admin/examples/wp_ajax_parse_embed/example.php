<?php
// Ajax handler for the editor's embed previews: turns a URL or [embed] shortcode into the embed HTML and sends it as JSON.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
$sent = json_decode( guide_ajax( 'wp_ajax_parse_embed', array( 'post_ID' => $post, 'shortcode' => '[embed]https://example.org/nothing[/embed]', 'type' => 'embed' ) ), true );
return $sent['success'];
