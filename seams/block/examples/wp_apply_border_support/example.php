<?php
// The classes and inline styles for a block's border: radius, width, style and color, a preset color as a has-border-color class.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
return wp_apply_border_support( $type, array( 'borderColor' => 'contrast', 'style' => array( 'border' => array( 'radius' => '8px', 'width' => '2px' ) ) ) );
