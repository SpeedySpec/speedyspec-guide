<?php
// Adds the open/close button with plus and minus icons after a top-level primary menu item that has children; on walker_nav_menu_start_el.
guide_theme( 'twentytwentyone' );
$args = (object) array( 'theme_location' => 'primary', 'link_before' => '', 'link_after' => '' );
$parent = (object) array( 'classes' => array( 'menu-item-has-children' ) );
$out = twenty_twenty_one_add_sub_menu_toggle( '<a>Item</a>', $parent, 0, $args );
return array( preg_replace( '/<svg.*?<\/svg>/s', '<svg/>', $out ), twenty_twenty_one_add_sub_menu_toggle( '<a>Leaf</a>', (object) array( 'classes' => array() ), 0, $args ) );
