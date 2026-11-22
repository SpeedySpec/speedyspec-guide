<?php
// Adds the className attribute to block types that support customClassName (all by default).
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array() ) );
wp_register_custom_classname_support( $type );
return $type->attributes['className'];
