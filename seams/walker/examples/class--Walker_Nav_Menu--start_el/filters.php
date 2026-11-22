<?php
// Every part has a filter: the item's args, classes, id, li attributes, title, link attributes and the whole item; and the sub-menu's classes and attributes.
function guide_item( $id, $title, $parent = 0, $extra = array() ) { return (object) ( $extra + array( 'ID' => $id, 'db_id' => $id, 'menu_item_parent' => $parent, 'title' => $title, 'url' => "http://example.org/$id", 'classes' => array( 'menu-item' ), 'target' => '', 'xfn' => '', 'attr_title' => '', 'current' => false ) ); }
$args = (object) array( 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'item_spacing' => 'discard' );
function guide_wrap_link_text( $args ) {
	$args = clone $args;
	$args->link_before = '<span>';
	$args->link_after = '</span>';
	return $args;
}
add_filter( 'nav_menu_item_args', 'guide_wrap_link_text' );
function guide_item_classes( $classes ) {
	return array( 'c' );
}
add_filter( 'nav_menu_css_class', 'guide_item_classes' );
function guide_no_item_id( $id ) {
	return '';
}
add_filter( 'nav_menu_item_id', 'guide_no_item_id' );
function guide_add_li_attribute( $atts ) {
	return $atts + array( 'data-li' => '1' );
}
add_filter( 'nav_menu_item_attributes', 'guide_add_li_attribute' );
function guide_uppercase_title( $title ) {
	return strtoupper( $title );
}
add_filter( 'nav_menu_item_title', 'guide_uppercase_title' );
function guide_add_link_attribute( $atts ) {
	return $atts + array( 'data-a' => '1' );
}
add_filter( 'nav_menu_link_attributes', 'guide_add_link_attribute' );
function guide_wrap_item_output( $item_output ) {
	return "($item_output)";
}
add_filter( 'walker_nav_menu_start_el', 'guide_wrap_item_output' );
function guide_submenu_classes( $classes ) {
	return array( 'sub' );
}
add_filter( 'nav_menu_submenu_css_class', 'guide_submenu_classes' );
function guide_add_submenu_attribute( $atts ) {
	return $atts + array( 'data-ul' => '1' );
}
add_filter( 'nav_menu_submenu_attributes', 'guide_add_submenu_attribute' );
return ( new Walker_Nav_Menu() )->walk( array( guide_item( 1, 'Home' ), guide_item( 2, 'Docs', 1 ) ), 0, $args );
