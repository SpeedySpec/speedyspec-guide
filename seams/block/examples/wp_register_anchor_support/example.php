<?php
// Adds the anchor attribute to block types that support anchor.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'anchor' => true ) ) );
wp_register_anchor_support( $type );
return $type->attributes['anchor'];
