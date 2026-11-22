<?php
// Adds the style attribute (and borderColor) to block types that support border.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( '__experimentalBorder' => array( 'color' => true ) ) ) );
wp_register_border_support( $type );
return array_keys( $type->attributes );
