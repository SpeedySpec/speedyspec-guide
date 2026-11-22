<?php
// The inline styles for a block's padding and margin, presets as CSS variables.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
return wp_apply_spacing_support( $type, array( 'style' => array( 'spacing' => array( 'padding' => array( 'top' => '1em', 'left' => 'var:preset|spacing|40' ) ) ) ) );
