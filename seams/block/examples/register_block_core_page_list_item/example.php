<?php
// Hooked to init: registers the Page List Item block (core/page-list-item) from its block.json.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/page-list-item' );
return array( $type->name, $type->title, is_string( $type->render_callback ) ? $type->render_callback : null );
