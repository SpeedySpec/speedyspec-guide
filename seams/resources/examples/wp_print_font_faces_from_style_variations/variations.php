<?php
// Prints the @font-face rules of the fonts in the active theme's style variations, for the Site Editor.
guide_theme( 'twentytwentyfive' );
$html = guide_render( 'wp_print_font_faces_from_style_variations' );
return array( str_starts_with( $html, '<style class="wp-fonts-local">' ), substr_count( $html, '@font-face' ) > 0 );
