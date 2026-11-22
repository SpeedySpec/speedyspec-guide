<?php
// Hooked to render_block: for a block with state styles (such as :hover), adds a unique class and its scoped rules.
$html = render_block( parse_blocks( '<!-- wp:button {"style":{":hover":{"color":{"text":"#ff0000"}}}} --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Go</a></div><!-- /wp:button -->' )[0] );
return str_contains( $html, 'wp-states-' ) || str_contains( $html, 'wp-block-button' );
