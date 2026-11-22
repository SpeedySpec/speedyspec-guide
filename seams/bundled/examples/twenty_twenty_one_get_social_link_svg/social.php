<?php
// The social network icon for a URL, by its domain; empty when none matches.
guide_theme( 'twentytwentyone' );
return array( (fn( $s ) => preg_replace( '/<path.*<\/svg>/s', '…</svg>', $s ))( twenty_twenty_one_get_social_link_svg( 'https://github.com/x', 24 ) ), twenty_twenty_one_get_social_link_svg( 'https://example.org/', 24 ) );
