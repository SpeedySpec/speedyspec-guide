<?php
// The theme's icons: get_svg() gives one with accessibility attributes in a color (hashes encoded), null when unknown; get_social_link_svg() matches a URL's domain to a social icon. The groups, color and domain map are filtered.
guide_theme( 'twentytwenty' );
return array( (fn( $s ) => preg_replace( '/<(path|polygon).*<\/svg>/s', '…</svg>', (string) $s ))( TwentyTwenty_SVG_Icons::get_svg( 'search', 'ui', '#123456' ) ), TwentyTwenty_SVG_Icons::get_svg( 'nope' ), (fn( $s ) => preg_replace( '/<(path|polygon).*<\/svg>/s', '…</svg>', (string) $s ))( TwentyTwenty_SVG_Icons::get_social_link_svg( 'https://github.com/x' ) ), TwentyTwenty_SVG_Icons::get_social_link_svg( 'https://example.org/' ) );
