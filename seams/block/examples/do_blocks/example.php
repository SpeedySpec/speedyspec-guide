<?php
// Hooked to the_content: renders the blocks in content, keeping wpautop off for block content.
return trim( do_blocks( '<!-- wp:paragraph --><p>Hi</p><!-- /wp:paragraph --><!-- wp:separator --><hr class="wp-block-separator"/><!-- /wp:separator -->' ) );
