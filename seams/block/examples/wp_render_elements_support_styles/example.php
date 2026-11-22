<?php
// Hooked to render_block_data: for a block with element styles, adds a scoping class and its stylesheet, parents before children.
$block = wp_render_elements_support_styles( parse_blocks( '<!-- wp:group {"style":{"elements":{"link":{"color":{"text":"red"}}}}} --><div class="wp-block-group"></div><!-- /wp:group -->' )[0] );
return str_contains( $block['attrs']['className'] ?? '', 'wp-elements-' );
