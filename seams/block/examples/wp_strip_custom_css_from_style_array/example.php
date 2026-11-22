<?php
// A style attribute without its custom CSS, at every state.
return wp_strip_custom_css_from_style_array( array( 'css' => 'x', 'color' => array( 'text' => 'red' ), ':hover' => array( 'css' => 'y' ) ) );
