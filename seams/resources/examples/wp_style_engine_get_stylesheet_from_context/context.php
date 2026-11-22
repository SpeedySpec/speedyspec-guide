<?php
// The stylesheet of the rules stored in a context, such as block-supports.
wp_style_engine_get_styles( array( 'spacing' => array( 'margin' => '4px' ) ), array( 'selector' => '.x', 'context' => 'guide-context' ) );
return wp_style_engine_get_stylesheet_from_context( 'guide-context' );
