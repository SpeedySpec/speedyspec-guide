<?php
// The classes and inline styles for a block's colors: preset colors as has-{slug}-color classes, custom ones inline.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return wp_apply_colors_support( $type, array( 'textColor' => 'accent', 'style' => array( 'color' => array( 'background' => '#fafafa' ) ) ) );
