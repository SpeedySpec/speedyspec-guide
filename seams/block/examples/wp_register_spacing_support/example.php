<?php
// Adds the style attribute to block types that support spacing.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'spacing' => array( 'padding' => true ) ) ) );
wp_register_spacing_support( $type );
return isset( $type->attributes['style'] );
