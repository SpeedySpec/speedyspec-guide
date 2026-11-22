<?php
// Unregisters a block type; the removed type, or false with a notice when it wasn't registered.
register_block_type( 'guide/temp' );
return array( unregister_block_type( 'guide/temp' )->name, unregister_block_type( 'guide/temp' ) );
