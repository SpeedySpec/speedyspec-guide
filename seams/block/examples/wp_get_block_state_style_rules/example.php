<?php
// The compiled CSS rules for a block's state styles (:hover, :focus and the rest), each with the selector it targets.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/button' );
return wp_get_block_state_style_rules( array( ':hover' => array( 'color' => array( 'text' => 'red' ) ) ), $type );
