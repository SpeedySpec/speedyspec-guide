<?php
// Adds the style attribute to block types that support customCSS.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'customCSS' => true ) ) );
wp_register_custom_css_support( $type );
return isset( $type->attributes['style'] );
