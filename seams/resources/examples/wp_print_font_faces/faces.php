<?php
// Prints the @font-face rules of fonts given (or of the active theme's theme.json fonts) in a style tag.
return guide_render( fn() => wp_print_font_faces( array( 'Inter' => array( array( 'font-family' => 'Inter', 'src' => array( 'https://cdn.example/inter.woff2' ), 'font-weight' => '400' ) ) ) ) );
