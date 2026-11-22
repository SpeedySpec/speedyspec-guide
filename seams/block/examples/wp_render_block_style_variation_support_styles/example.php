<?php
// Hooked to render_block_data: for a block using a theme.json style variation, adds a unique class and enqueues that variation's styles scoped to it, parents before children.
switch_theme( 'twentytwentyfive' );
$block = wp_render_block_style_variation_support_styles( parse_blocks( '<!-- wp:group {"className":"is-style-section-1"} --><div class="wp-block-group is-style-section-1"></div><!-- /wp:group -->' )[0] );
return (bool) preg_match( '/is-style-section-1--[0-9a-f]+/', $block['attrs']['className'] );
