<?php
// The inner markup of a serialized block, without its own delimiters.
return remove_serialized_parent_block( '<!-- wp:group --><div><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></div><!-- /wp:group -->' );
