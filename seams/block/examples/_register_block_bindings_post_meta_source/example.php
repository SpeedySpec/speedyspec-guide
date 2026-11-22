<?php
// Hooked to init: registers the core/post-meta bindings source.
unregister_block_bindings_source( 'core/post-meta' );
_register_block_bindings_post_meta_source();
return get_block_bindings_source( 'core/post-meta' )->uses_context;
