<?php
// A theme icon of a group (ui or social) in a color, run through wp_kses; false when unknown.
guide_theme( 'twentytwenty' );
return array( (fn( $s ) => preg_replace( '/<(path|polygon).*<\/svg>/s', '…</svg>', (string) $s ))( twentytwenty_get_theme_svg( 'search', 'ui', '#ff0000' ) ), twentytwenty_get_theme_svg( 'nope' ) );
