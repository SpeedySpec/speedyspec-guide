<?php
// Parses block markup into blocks: name, attributes, inner blocks, inner HTML and inner content; filtered by block_parser_class.
return parse_blocks( '<!-- wp:heading {"level":3} --><h3>Title</h3><!-- /wp:heading -->' )[0];
