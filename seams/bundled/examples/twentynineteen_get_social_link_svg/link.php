<?php
// The social network icon matching a URL's domain; null when none matches.
guide_theme( 'twentynineteen' );
return array( (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( twentynineteen_get_social_link_svg( 'https://twitter.com/x', 32 ) ), twentynineteen_get_social_link_svg( 'https://example.org/' ) );
