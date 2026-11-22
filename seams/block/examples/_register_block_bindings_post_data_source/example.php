<?php
// Hooked to init: registers the core/post-data bindings source.
unregister_block_bindings_source( 'core/post-data' );
_register_block_bindings_post_data_source();
return get_block_bindings_source( 'core/post-data' )->label;
