<?php
// Runs a block theme template's content through the content filters a post's content gets, without wpautop.
return trim( _wp_apply_block_content_filters( '<!-- wp:paragraph --><p>x :)</p><!-- /wp:paragraph -->' ) );
