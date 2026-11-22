<?php
// The align{value} class for a block's align attribute, when the block supports it.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'align' => true ) ) );
return wp_apply_alignment_support( $type, array( 'align' => 'wide' ) );
