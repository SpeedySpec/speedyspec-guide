<?php
// An SVG icon of a group (ui or social) at a size, from Twenty_Twenty_One_SVG_Icons; empty when unknown.
guide_theme( 'twentytwentyone' );
return array( (fn( $s ) => preg_replace( '/<path.*<\/svg>/s', '…</svg>', $s ))( twenty_twenty_one_get_icon_svg( 'ui', 'arrow_right', 16 ) ), twenty_twenty_one_get_icon_svg( 'ui', 'nope' ) );
