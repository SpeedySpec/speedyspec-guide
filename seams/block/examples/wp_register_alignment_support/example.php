<?php
// Adds the align attribute to block types that support align.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'align' => true ) ) );
wp_register_alignment_support( $type );
return $type->attributes['align'];
