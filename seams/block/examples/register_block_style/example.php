<?php
// Registers a style variation for block types (a name, label, and inline CSS or a style handle or style data).
register_block_style( 'core/quote', array( 'name' => 'fancy', 'label' => 'Fancy', 'inline_style' => '.is-style-fancy{font-style:italic}' ) );
return array_keys( WP_Block_Styles_Registry::get_instance()->get_registered_styles_for_block( 'core/quote' ) );
