<?php
// The block types controller describes registered block types at /wp/v2/block-types, by namespace and name, with their attributes, supports and assets; the block renderer controller renders a dynamic block with attributes at /wp/v2/block-renderer/<name>.
function guide_render_hello( $attributes ) {
	return "<p>Hello {$attributes['who']}</p>";
}
register_block_type( 'guide/hello', array( 'attributes' => array( 'who' => array( 'type' => 'string', 'default' => 'world' ) ), 'render_callback' => 'guide_render_hello' ) );
$type = guide_rest( 'GET', '/wp/v2/block-types/guide/hello' )[1];
$rendered = guide_rest( 'GET', '/wp/v2/block-renderer/guide/hello', array( 'context' => 'edit', 'attributes' => array( 'who' => 'REST' ) ) )[1];
return array( $type['name'], $type['attributes']['who'], $type['is_dynamic'], $rendered['rendered'] );
