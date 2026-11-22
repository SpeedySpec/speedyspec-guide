<?php
// A parsed block back as block markup, inner blocks included.
$blocks = parse_blocks( '<!-- wp:quote --><blockquote><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></blockquote><!-- /wp:quote -->' );
return serialize_block( $blocks[0] );
