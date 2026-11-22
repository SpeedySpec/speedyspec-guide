<?php
// Splits a state style by the block's feature selectors, so each part targets its own element.
return count( wp_get_state_style_groups( array( 'color' => array( 'text' => 'red' ), 'border' => array( 'width' => '1px' ) ), array( 'root' => '.wp-block-button .wp-block-button__link' ) ) );
