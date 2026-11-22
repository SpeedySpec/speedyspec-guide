<?php
// A block theme's template is block markup: its outer blocks, and the template parts it pulls in by slug.
switch_theme( 'twentytwentyfive' );
$single = get_block_template( 'twentytwentyfive//single' );
$blocks = parse_blocks( $single->content );
$names  = array_values( array_filter( wp_list_pluck( $blocks, 'blockName' ) ) );
$parts  = array();
foreach ( $blocks as $block ) {
	if ( 'core/template-part' === $block['blockName'] ) {
		$parts[] = $block['attrs']['slug'];
	}
}
return array( 'outer blocks' => $names, 'template parts' => $parts, 'id' => $single->id );
