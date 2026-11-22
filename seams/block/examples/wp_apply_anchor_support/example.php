<?php
// The id attribute for a block's anchor, when the block supports anchors.
$type = new WP_Block_Type( 'guide/box', array( 'supports' => array( 'anchor' => true ) ) );
return wp_apply_anchor_support( $type, array( 'anchor' => 'section-2' ) );
