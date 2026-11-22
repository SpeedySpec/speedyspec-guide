<?php
// Adds the style attribute to block types that support background.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'background' => array( 'backgroundImage' => true ) ) ) );
wp_register_background_support( $type );
return $type->attributes['style'];
