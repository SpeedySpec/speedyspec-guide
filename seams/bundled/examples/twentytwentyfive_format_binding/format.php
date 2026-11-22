<?php
// The current post's format name, such as Quote; nothing for standard posts.
guide_theme( 'twentytwentyfive' );
$post = wp_insert_post( array( 'post_title' => 'Q', 'post_status' => 'publish' ) );
set_post_format( $post, 'quote' );
$GLOBALS['post'] = get_post( $post );
$quote = twentytwentyfive_format_binding();
set_post_format( $post, '' );
return array( $quote, twentytwentyfive_format_binding() );
