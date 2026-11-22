<?php
// Hooked to init: registers the Details block (core/details) from its block.json.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/details' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
