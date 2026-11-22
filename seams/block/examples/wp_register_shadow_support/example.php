<?php
// Adds the style attribute to block types that support shadow.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'shadow' => true ) ) );
wp_register_shadow_support( $type );
return isset( $type->attributes['style'] );
