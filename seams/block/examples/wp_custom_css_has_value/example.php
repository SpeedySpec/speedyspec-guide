<?php
// Whether a style node has non-empty custom CSS.
return array( wp_custom_css_has_value( array( 'css' => 'color: red' ) ), wp_custom_css_has_value( array( 'css' => '  ' ) ), wp_custom_css_has_value( array() ) );
