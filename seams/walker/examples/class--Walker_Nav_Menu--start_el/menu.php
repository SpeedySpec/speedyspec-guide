<?php
// A menu as wp_nav_menu() writes it: li with id and classes, the link, and sub-menus in ul.sub-menu.
function guide_item( $id, $title, $parent = 0, $extra = array() ) { return (object) ( $extra + array( 'ID' => $id, 'db_id' => $id, 'menu_item_parent' => $parent, 'title' => $title, 'url' => "http://example.org/$id", 'classes' => array( 'menu-item' ), 'target' => '', 'xfn' => '', 'attr_title' => '', 'current' => false ) ); }
$args = (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'item_spacing' => 'discard' );
$items = array( guide_item( 1, 'Home', 0, array( 'current' => true ) ), guide_item( 2, 'Docs', 1, array( 'target' => '_blank', 'xfn' => 'nofollow', 'attr_title' => 'All docs' ) ) );
return ( new Walker_Nav_Menu() )->walk( $items, 0, $args );
