<?php
// A social network icon by name at a size.
guide_theme( 'twentynineteen' );
return (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( twentynineteen_get_social_icon_svg( 'github', 20 ) );
