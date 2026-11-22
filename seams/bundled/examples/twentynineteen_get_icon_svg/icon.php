<?php
// A ui icon at a size, from TwentyNineteen_SVG_Icons; empty when unknown.
guide_theme( 'twentynineteen' );
return array( (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( twentynineteen_get_icon_svg( 'watch', 16 ) ), twentynineteen_get_icon_svg( 'nope' ) );
