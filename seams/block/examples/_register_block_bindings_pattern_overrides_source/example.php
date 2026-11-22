<?php
// Hooked to init: registers the core/pattern-overrides bindings source.
unregister_block_bindings_source( 'core/pattern-overrides' );
_register_block_bindings_pattern_overrides_source();
return get_block_bindings_source( 'core/pattern-overrides' )->uses_context;
