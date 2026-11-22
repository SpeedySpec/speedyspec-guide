<?php
// Adds the ariaLabel attribute to block types that support ariaLabel.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'ariaLabel' => true ) ) );
wp_register_aria_label_support( $type );
return $type->attributes['ariaLabel'];
