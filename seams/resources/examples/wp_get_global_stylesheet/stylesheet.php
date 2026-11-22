<?php
// The stylesheet from theme.json: variables (presets), styles, presets and base layout styles, or the types asked for; cached unless the theme is being developed.
guide_theme( 'twentytwentyfive' );
$vars = wp_get_global_stylesheet( array( 'variables' ) );
return array( str_starts_with( $vars, ':root{--wp--preset--' ), strlen( wp_get_global_stylesheet() ) > strlen( $vars ) );
