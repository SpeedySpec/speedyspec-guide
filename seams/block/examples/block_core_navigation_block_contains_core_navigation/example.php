<?php
// Whether a Navigation block holds another Navigation block, which would recurse.
$inner = new WP_Block_List( parse_blocks( '<!-- wp:navigation /-->' ) );
return block_core_navigation_block_contains_core_navigation( $inner );
