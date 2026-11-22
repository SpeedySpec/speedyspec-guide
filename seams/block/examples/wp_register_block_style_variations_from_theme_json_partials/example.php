<?php
// Registers the block style variations described in a theme's styles partials for the blocks they name.
wp_register_block_style_variations_from_theme_json_partials( array( array( 'title' => 'Bold', 'slug' => 'bold', 'blockTypes' => array( 'core/quote' ), 'styles' => array() ) ) );
return array_keys( WP_Block_Styles_Registry::get_instance()->get_registered_styles_for_block( 'core/quote' ) );
