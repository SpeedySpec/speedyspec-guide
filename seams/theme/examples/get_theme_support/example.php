<?php
// A feature's arguments, or one argument of it; false when unsupported.
add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 200 ) );
return array( get_theme_support( 'custom-logo', 'height' ), get_theme_support( 'nope' ) );
