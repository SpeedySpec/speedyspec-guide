<?php
// The aria-label attribute for a block's ariaLabel, when supported.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'ariaLabel' => true ) ) );
return wp_apply_aria_label_support( $type, array( 'ariaLabel' => 'Main navigation' ) );
