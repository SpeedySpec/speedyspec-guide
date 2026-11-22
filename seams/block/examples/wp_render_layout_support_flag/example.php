<?php
// Hooked to render_block: adds a block's layout classes and its generated container styles (is-layout-*, wp-container-*) to its wrapper.
$html = render_block( parse_blocks( '<!-- wp:group {"layout":{"type":"constrained","contentSize":"640px"}} --><div class="wp-block-group"><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></div><!-- /wp:group -->' )[0] );
return array( str_contains( $html, 'is-layout-constrained' ), (bool) preg_match( '/wp-block-group-is-layout-constrained/', $html ) );
