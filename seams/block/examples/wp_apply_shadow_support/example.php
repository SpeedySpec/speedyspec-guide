<?php
// The inline style for a block's box shadow.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'shadow' => true ) ) );
return wp_apply_shadow_support( $type, array( 'style' => array( 'shadow' => '0 1px 2px #000' ) ) );
