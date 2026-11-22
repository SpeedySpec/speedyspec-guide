<?php
// Hooked to render_block_data: when a Query block with enhanced pagination holds a block that doesn't support client navigation, turns client navigation off in the core/router interactivity config.
function guide_plain_block_render(): string
{
	return '<p>Plain</p>';
}
register_block_type( 'guide/plain', array( 'render_callback' => 'guide_plain_block_render' ) );
wp_insert_post( array( 'post_title' => 'Hello', 'post_status' => 'publish' ) );
do_blocks( '<!-- wp:query {"queryId":1,"enhancedPagination":true,"query":{"perPage":1}} --><div class="wp-block-query"><!-- wp:post-template --><!-- wp:guide/plain /--><!-- /wp:post-template --></div><!-- /wp:query -->' );
return wp_interactivity_config( 'core/router' );
