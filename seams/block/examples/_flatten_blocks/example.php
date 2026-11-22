<?php
// Every block in a tree, flat, by reference.
$blocks = parse_blocks( '<!-- wp:group --><div><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></div><!-- /wp:group -->' );
return array_column( _flatten_blocks( $blocks ), 'blockName' );
