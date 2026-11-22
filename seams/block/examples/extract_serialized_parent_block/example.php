<?php
// A serialized block's own opening and closing delimiters, without its inner content.
return extract_serialized_parent_block( '<!-- wp:group {"tagName":"main"} --><div>inner</div><!-- /wp:group -->' );
