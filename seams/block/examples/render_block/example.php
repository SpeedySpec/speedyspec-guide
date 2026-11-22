<?php
// Renders a parsed block to HTML through WP_Block: its render callback, supports and render_block filters; pre_render_block can replace it.
register_block_type( 'guide/hi', array( 'render_callback' => 'guide_render_hi' ) );
function guide_render_hi( $attributes, $content ) {
	return '<b>' . ( $attributes['name'] ?? 'you' ) . '</b>';
}
return render_block( parse_blocks( '<!-- wp:guide/hi {"name":"Ada"} /-->' )[0] );
