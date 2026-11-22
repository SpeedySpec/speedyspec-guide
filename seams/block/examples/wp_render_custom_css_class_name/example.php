<?php
// Hooked to render_block: puts the block's custom CSS class onto its markup, generating it for blocks a parent rendered itself.
return str_contains( render_block( parse_blocks( '<!-- wp:paragraph {"style":{"css":"color: red;"}} --><p class="wp-block-paragraph">Hi</p><!-- /wp:paragraph -->' )[0] ), 'wp-custom-css-' );
