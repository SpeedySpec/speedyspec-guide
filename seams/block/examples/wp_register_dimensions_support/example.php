<?php
// Adds the style attribute to block types that support dimensions.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'dimensions' => array( 'minHeight' => true ) ) ) );
wp_register_dimensions_support( $type );
return isset( $type->attributes['style'] );
