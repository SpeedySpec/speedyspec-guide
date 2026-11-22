<?php
// Shows a top-level menu item's description after its link, in a menu-item-description paragraph; on nav_menu_item_args.
guide_theme( 'twentytwentyone' );
$args = (object) array( 'link_after' => '' );
$with = twenty_twenty_one_add_menu_description_args( clone $args, (object) array( 'description' => 'About us' ), 0 );
$deep = twenty_twenty_one_add_menu_description_args( clone $args, (object) array( 'description' => 'About us' ), 1 );
return array( $with->link_after, $deep->link_after );
