<?php
// The inline styles for a block's dimensions (min height, height, width, aspect ratio).
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/group' );
return wp_apply_dimensions_support( $type, array( 'style' => array( 'dimensions' => array( 'minHeight' => '50vh' ) ) ) );
