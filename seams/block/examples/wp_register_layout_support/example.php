<?php
// Adds the layout attribute to block types that support layout.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'layout' => true ) ) );
wp_register_layout_support( $type );
return $type->attributes['layout'];
