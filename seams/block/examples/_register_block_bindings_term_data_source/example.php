<?php
// Hooked to init: registers the core/term-data bindings source.
unregister_block_bindings_source( 'core/term-data' );
_register_block_bindings_term_data_source();
return get_block_bindings_source( 'core/term-data' )->label;
