<?php
// Replaces the link text's end with the social network's icon (or a link icon) in social menu items; on walker_nav_menu_start_el.
guide_theme( 'twentynineteen' );
$args = (object) array( 'theme_location' => 'social', 'link_after' => '</span>' );
return (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( twentynineteen_nav_menu_social_icons( '<a href="https://github.com/x"><span>GitHub</span></a>', (object) array( 'url' => 'https://github.com/x' ), 0, $args ) );
