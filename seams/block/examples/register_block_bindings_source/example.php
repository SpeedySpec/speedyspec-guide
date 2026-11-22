<?php
// Registers a block bindings source by namespaced name, with its label and a callback giving the bound value; an error with a notice for bad names or duplicates.
function guide_binding_value( $args ) {
	return strtoupper( $args['key'] ?? '' );
}
$source = register_block_bindings_source( 'guide/upper', array( 'label' => 'Upper', 'get_value_callback' => 'guide_binding_value' ) );
return array( get_class( $source ), $source->get_value( array( 'key' => 'hi' ), null, 'content' ) );
