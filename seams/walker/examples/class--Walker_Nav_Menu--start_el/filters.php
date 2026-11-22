<?php
// Every part has a filter: the item's args, classes, id, li attributes, title, link attributes and the whole item; and the sub-menu's classes and attributes.
function guide_item( $id, $title, $parent = 0, $extra = array() ) { return (object) ( $extra + array( 'ID' => $id, 'db_id' => $id, 'menu_item_parent' => $parent, 'title' => $title, 'url' => "http://example.org/$id", 'classes' => array( 'menu-item' ), 'target' => '', 'xfn' => '', 'attr_title' => '', 'current' => false ) ); }
$args = (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'item_spacing' => 'discard' );
add_filter( 'nav_menu_item_args', function ( $a ) { $a = clone $a; $a->link_before = '<span>'; $a->link_after = '</span>'; return $a; } );
add_filter( 'nav_menu_css_class', fn( $c ) => array( 'c' ) );
add_filter( 'nav_menu_item_id', fn( $id ) => '' );
add_filter( 'nav_menu_item_attributes', fn( $a ) => $a + array( 'data-li' => '1' ) );
add_filter( 'nav_menu_item_title', fn( $t ) => strtoupper( $t ) );
add_filter( 'nav_menu_link_attributes', fn( $a ) => $a + array( 'data-a' => '1' ) );
add_filter( 'walker_nav_menu_start_el', fn( $out ) => "($out)" );
add_filter( 'nav_menu_submenu_css_class', fn( $c ) => array( 'sub' ) );
add_filter( 'nav_menu_submenu_attributes', fn( $a ) => $a + array( 'data-ul' => '1' ) );
return ( new Walker_Nav_Menu() )->walk( array( guide_item( 1, 'Home' ), guide_item( 2, 'Docs', 1 ) ), 0, $args );
