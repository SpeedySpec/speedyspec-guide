<?php
// Replaces core/pattern blocks with the registered patterns' blocks, recursively, once each.
register_block_pattern( 'guide/hi', array( 'title' => 'Hi', 'content' => '<!-- wp:paragraph --><p>Hi</p><!-- /wp:paragraph -->' ) );
$blocks = resolve_pattern_blocks( parse_blocks( '<!-- wp:pattern {"slug":"guide/hi"} /-->' ) );
return $blocks[0]['blockName'];
