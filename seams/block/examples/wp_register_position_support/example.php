<?php
// Adds the style attribute to block types that support position.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'position' => array( 'sticky' => true ) ) ) );
wp_register_position_support( $type );
return isset( $type->attributes['style'] );
