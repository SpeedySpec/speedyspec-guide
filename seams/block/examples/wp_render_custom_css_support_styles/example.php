<?php
// Hooked to render_block_data: for a block with custom CSS, records its class name in its attributes and adds its scoped stylesheet.
$block = wp_render_custom_css_support_styles( parse_blocks( '<!-- wp:paragraph {"style":{"css":"color: red;"}} --><p class="wp-block-paragraph">Hi</p><!-- /wp:paragraph -->' )[0] );
return str_contains( $block['attrs']['className'] ?? '', 'wp-custom-css-' );
