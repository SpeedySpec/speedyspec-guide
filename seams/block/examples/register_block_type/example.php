<?php
// Registers a block type from a name and arguments, or from a block.json folder; the WP_Block_Type, false on failure.
$type = register_block_type( 'guide/hello', array( 'attributes' => array( 'who' => array( 'type' => 'string', 'default' => 'world' ) ), 'render_callback' => 'guide_render_hello' ) );
function guide_render_hello( $attributes ) {
	return '<p>Hello ' . esc_html( $attributes['who'] ) . '</p>';
}
return array( get_class( $type ), $type->is_dynamic(), register_block_type( 'Bad Name' ) );
