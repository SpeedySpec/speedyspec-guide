<?php
// A stylesheet from rules (a selector with declarations), merged by selector, optionally prettified or stored in a context.
return wp_style_engine_get_stylesheet_from_css_rules( array( array( 'selector' => '.a', 'declarations' => array( 'color' => 'red' ) ), array( 'selector' => '.a', 'declarations' => array( 'margin' => '0' ) ), array( 'selector' => '.b', 'declarations' => array( 'padding' => '1em' ) ) ) );
