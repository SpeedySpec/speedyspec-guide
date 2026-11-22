<?php
// Renders the inner blocks allowed in excerpts, for excerpt_remove_blocks().
$block = parse_blocks( '<!-- wp:group --><div><!-- wp:paragraph --><p>In</p><!-- /wp:paragraph --></div><!-- /wp:group -->' )[0];
return _excerpt_render_inner_blocks( $block, array( 'core/paragraph' ) );
