<?php
// Prints a theme icon.
guide_theme( 'twentytwenty' );
return (fn( $s ) => preg_replace( '/<(path|polygon).*<\/svg>/s', '…</svg>', (string) $s ))( guide_render( fn() => twentytwenty_the_theme_svg( 'search' ) ) );
