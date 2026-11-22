<?php
// Adds the fontSize, fontFamily and style attributes to block types that support typography.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'typography' => array( 'fontSize' => true ) ) ) );
wp_register_typography_support( $type );
return array_keys( $type->attributes );
