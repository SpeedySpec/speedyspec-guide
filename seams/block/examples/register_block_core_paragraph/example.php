<?php
// Hooked to init: registers the Paragraph block (core/paragraph) from its block.json.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
