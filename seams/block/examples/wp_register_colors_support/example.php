<?php
// Adds the textColor, backgroundColor, gradient and style attributes to block types that support color.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'color' => array( 'text' => true, 'background' => true, 'gradients' => true ) ) ) );
wp_register_colors_support( $type );
return array_keys( $type->attributes );
