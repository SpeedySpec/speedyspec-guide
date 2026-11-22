<?php
// Hooked to init: registers the static core blocks from the metadata collection; dynamic ones register themselves.
unregister_block_type( 'core/spacer' );
register_core_block_types_from_metadata();
return WP_Block_Type_Registry::get_instance()->is_registered( 'core/spacer' );
