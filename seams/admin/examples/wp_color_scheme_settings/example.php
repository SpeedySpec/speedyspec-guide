<?php
// Prints the colors of the user's admin color scheme for the scripts that use them, such as the SVG menu icons.
register_admin_color_schemes();
return str_contains( guide_render( 'wp_color_scheme_settings' ), '_wpColorScheme' );
