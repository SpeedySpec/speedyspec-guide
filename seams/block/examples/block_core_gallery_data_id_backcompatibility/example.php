<?php
// Hooked to render_block_data: gives each Image block in a Gallery a data-id attribute from its image ID, for themes and plugins that read it.
$block = parse_blocks( '<!-- wp:gallery --><figure class="wp-block-gallery"><!-- wp:image {"id":42} --><figure class="wp-block-image"><img src="a.jpg" class="wp-image-42"/></figure><!-- /wp:image --></figure><!-- /wp:gallery -->' )[0];
$block = block_core_gallery_data_id_backcompatibility( $block );
return $block['innerBlocks'][0]['attrs'];
