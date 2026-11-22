<?php
// Hooked to render_block_context: gives a Gallery block's images a unique gallery ID in context, for the lightbox.
$gallery = parse_blocks( '<!-- wp:gallery --><figure class="wp-block-gallery"></figure><!-- /wp:gallery -->' )[0];
$context = block_core_gallery_render_context( array(), $gallery );
return array_keys( $context );
