<?php
// The theme's custom background color support: CSS variables for a non-default background on the front end and in the editor, and the is-dark-theme or is-light-theme body class (has-background-white when nearly white). The theme makes one when it loads.
guide_theme( 'twentytwentyone' );
set_theme_mod( 'background_color', '000000' );
$colors = new Twenty_Twenty_One_Custom_Colors();
return array( $colors->body_class( array() ), $colors->custom_get_readable_color( '000000' ), $colors->generate_custom_color_variables(), Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( 'fff' ) );
