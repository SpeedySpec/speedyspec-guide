<?php
// Registers the theme's block styles, such as Evening for Code and Sharp for Site Logo; on init.
guide_theme( 'ipsum' );
ipsum_register_block_styles();
$styles = WP_Block_Styles_Registry::get_instance()->get_all_registered();
return array( array_keys( $styles['core/code'] ), array_keys( $styles['core/site-logo'] ), count( $styles ) );
