<?php
// Hooked to init: registers the Footnotes block (core/footnotes) from its block.json, with render_block_core_footnotes() as its render callback.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/footnotes' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
