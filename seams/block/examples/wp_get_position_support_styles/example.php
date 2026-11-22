<?php
// The CSS for a block's position (sticky or fixed) under a selector, with the admin bar offset for sticky top.
return wp_get_position_support_styles( '.wp-container-1', array( 'type' => 'sticky', 'top' => '0px' ), array( 'sticky' ) );
