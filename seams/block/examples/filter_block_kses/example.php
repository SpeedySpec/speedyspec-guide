<?php
// Filters a parsed block's attribute values and inner blocks through kses.
$block = parse_blocks( '<!-- wp:paragraph {"label":"<b onclick=1>x</b>"} --><p>y</p><!-- /wp:paragraph -->' )[0];
return filter_block_kses( $block, 'post' )['attrs'];
