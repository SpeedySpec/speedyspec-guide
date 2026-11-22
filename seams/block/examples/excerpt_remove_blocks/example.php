<?php
// Content stripped to the blocks allowed in excerpts (paragraphs, headings and other text), their dynamic parts rendered, for automatic excerpts; filtered by excerpt_allowed_blocks.
return excerpt_remove_blocks( '<!-- wp:paragraph --><p>Text</p><!-- /wp:paragraph --><!-- wp:image --><figure><img src="a.jpg"/></figure><!-- /wp:image -->' );
