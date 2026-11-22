<?php
// Puts the social network icon in place of the link text's start in footer menu items; on walker_nav_menu_start_el.
guide_theme( 'twentytwentyone' );
$args = (object) array( 'theme_location' => 'footer', 'link_before' => '<span>', 'link_after' => '</span>' );
$item = (object) array( 'url' => 'https://github.com/x' );
return (fn( $s ) => preg_replace( '/<path.*<\/svg>/s', '…</svg>', $s ))( twenty_twenty_one_nav_menu_social_icons( '<a href="https://github.com/x"><span>GitHub</span></a>', $item, 0, $args ) );
