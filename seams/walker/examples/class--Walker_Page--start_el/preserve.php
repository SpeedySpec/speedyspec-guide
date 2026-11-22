<?php
// item_spacing preserve indents with tabs and newlines; show_date adds the date; page_css_class and page_menu_link_attributes filter the classes and the link.
guide_page( 1, 'About' ); guide_page( 2, 'Team', 1 ); guide_page( 3, 'Contact' );
$pages = array( get_post( 1 ), get_post( 2 ), get_post( 3 ) );
function guide_page_classes( $classes ) {
	return array( 'p' );
}
add_filter( 'page_css_class', 'guide_page_classes' );
function guide_add_page_link_attribute( $atts ) {
	return $atts + array( 'data-x' => '1' );
}
add_filter( 'page_menu_link_attributes', 'guide_add_page_link_attribute' );
return ( new Walker_Page() )->walk( array( $pages[0], $pages[1] ), 0, array( 'item_spacing' => 'preserve', 'show_date' => 'modified', 'date_format' => 'Y' ), 0 );
