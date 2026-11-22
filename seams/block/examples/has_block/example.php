<?php
// Whether content (or a post's) contains a block type, core/ assumed for bare names, inside reusable blocks too.
$c = '<!-- wp:group --><div><!-- wp:image /--></div><!-- /wp:group -->';
return array( has_block( 'image', $c ), has_block( 'core/group', $c ), has_block( 'core/quote', $c ) );
