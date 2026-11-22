<?php
// Queues the styles stored by the style engine for block supports (and other contexts) as inline styles, in the head or the footer.
wp_style_engine_get_styles( array( 'spacing' => array( 'margin' => '7px' ) ), array( 'selector' => '.guide', 'context' => 'block-supports' ) );
wp_enqueue_stored_styles();
return implode( '', (array) wp_styles()->get_data( 'core-block-supports', 'after' ) );
