<?php
// One of the active theme's modifications, or a default (sprintf'd with the theme's URLs); filtered by theme_mod_{$name}.
set_theme_mod( 'accent', 'red' );
return array( get_theme_mod( 'accent' ), get_theme_mod( 'missing', 'blue' ), get_theme_mod( 'logo', '%s/logo.png' ) );
