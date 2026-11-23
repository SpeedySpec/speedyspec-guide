<?php
// Ajax handler that caches the oEmbed HTML of the URLs in a post's content when the post is saved; answers 1 or 0.
$post = wp_insert_post( array( 'post_title' => 'Tea', 'post_status' => 'publish' ) );
return guide_ajax( 'wp_ajax_oembed_cache', array( 'post' => $post ) );
