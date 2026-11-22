<?php
// In the primary menu, adds an expand button with a down arrow after parents, and turns the mobile copy of a parent into a back button; on walker_nav_menu_start_el.
guide_theme( 'twentynineteen' );
$args = (object) array( 'theme_location' => 'menu-1' );
$parent = twentynineteen_add_dropdown_icons( '<a href="#">About</a>', (object) array( 'classes' => array( 'menu-item-has-children' ) ), 0, $args );
$back = twentynineteen_add_dropdown_icons( '<a href="#">About</a>', (object) array( 'classes' => array( 'mobile-parent-nav-menu-item' ), 'original_id' => 5 ), 1, $args );
return array( (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( $parent ), (fn( $s ) => preg_replace( '/<(path|polygon|g).*<\/svg>/s', '…</svg>', (string) $s ))( $back ) );
