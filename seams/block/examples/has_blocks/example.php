<?php
// Whether content (or a post's) contains block markup.
return array( has_blocks( '<!-- wp:paragraph --><p>x</p><!-- /wp:paragraph -->' ), has_blocks( '<p>plain</p>' ) );
