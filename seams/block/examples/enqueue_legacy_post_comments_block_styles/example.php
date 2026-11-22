<?php
// Enqueues the styles of the old Post Comments block, for the Comments block's legacy fallback.
add_filter( 'should_load_block_assets_on_demand', '__return_true' );
enqueue_legacy_post_comments_block_styles( 'core/comments' );
$id = wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
guide_go( "/?p=$id" );
the_post();
render_block( parse_blocks( '<!-- wp:comments --><div class="wp-block-comments"><!-- wp:comment-template --><!-- wp:comment-content /--><!-- /wp:comment-template --></div><!-- /wp:comments -->' )[0] );
return array( wp_style_is( 'wp-block-post-comments', 'enqueued' ), wp_style_is( 'wp-block-button', 'enqueued' ) );
