<?php
// CSS declarations and class names from a block's style object (spacing, color, typography, border and more), with a selector giving a rule; preset values become CSS variables, and a context stores them for later.
$styles = wp_style_engine_get_styles( array( 'spacing' => array( 'padding' => '10px' ), 'color' => array( 'text' => 'var:preset|color|primary' ) ), array( 'selector' => '.guide' ) );
return $styles;
