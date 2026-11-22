<?php
// Serializes a block, calling a callback before and after each inner block so it can change it or add markup.
$block = parse_blocks( '<!-- wp:group --><div><!-- wp:paragraph --><p>x</p><!-- /wp:paragraph --></div><!-- /wp:group -->' )[0];
function guide_mark_before( &$block ) {
	return '<!-- before ' . $block['blockName'] . ' -->';
}
return traverse_and_serialize_block( $block, 'guide_mark_before' );
