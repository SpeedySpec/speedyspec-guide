<?php
// The first registered style variation among a class string's is-style-* classes, ignoring default; null when none.
register_block_style( 'core/quote', array( 'name' => 'fancy', 'label' => 'Fancy' ) );
$styles = WP_Block_Styles_Registry::get_instance()->get_registered_styles_for_block( 'core/quote' );
return array( wp_get_block_style_variation_name_from_registered_style( 'other is-style-fancy', $styles ), wp_get_block_style_variation_name_from_registered_style( 'is-style-plain', $styles ) );
