<?php
// The block's additional CSS classes from its className attribute.
$type = WP_Block_Type_Registry::get_instance()->get_registered( 'core/paragraph' );
return wp_apply_custom_classname_support( $type, array( 'className' => 'lead  big' ) );
