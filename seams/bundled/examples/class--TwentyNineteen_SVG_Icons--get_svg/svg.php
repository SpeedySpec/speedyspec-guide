<?php
// The theme's icons: get_svg() gives one of a group (ui or social) at a size with accessibility attributes, empty when unknown; get_social_link_svg() matches a URL's domain to a social icon.
guide_theme( 'twentynineteen' );
return array( (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( TwentyNineteen_SVG_Icons::get_svg( 'ui', 'link', 12 ) ), TwentyNineteen_SVG_Icons::get_svg( 'ui', 'nope', 12 ), (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( TwentyNineteen_SVG_Icons::get_social_link_svg( 'https://wordpress.org/', 16 ) ) );
