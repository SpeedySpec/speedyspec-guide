<?php
// Unregisters a block bindings source.
register_block_bindings_source( 'guide/x', array( 'label' => 'X', 'get_value_callback' => '__return_empty_string' ) );
return array( get_class( unregister_block_bindings_source( 'guide/x' ) ), unregister_block_bindings_source( 'guide/x' ) );
