<?php
// The first block of a name in a list of blocks, inner blocks searched; an empty array when none.
return wp_get_first_block( parse_blocks( '<!-- wp:group --><div><!-- wp:heading --><h2>A</h2><!-- /wp:heading --></div><!-- /wp:group -->' ), 'core/heading' )['innerHTML'];
