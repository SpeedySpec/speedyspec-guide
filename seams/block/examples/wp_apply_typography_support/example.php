<?php
// The classes and inline styles for a block's typography: preset font sizes and families as classes, custom values inline (fluid when on).
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return wp_apply_typography_support( $type, array( 'fontSize' => 'large', 'style' => array( 'typography' => array( 'lineHeight' => '1.6' ) ) ) );
