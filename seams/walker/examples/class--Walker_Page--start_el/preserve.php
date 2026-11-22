<?php
// item_spacing preserve indents with tabs and newlines; show_date adds the date; page_css_class and page_menu_link_attributes filter the classes and the link.
guide_page( 1, 'About' ); guide_page( 2, 'Team', 1 ); guide_page( 3, 'Contact' );
$pages = array( get_post( 1 ), get_post( 2 ), get_post( 3 ) );
add_filter( 'page_css_class', fn( $classes ) => array( 'p' ) );
add_filter( 'page_menu_link_attributes', fn( $atts ) => $atts + array( 'data-x' => '1' ) );
return ( new Walker_Page() )->walk( array( $pages[0], $pages[1] ), 0, array( 'item_spacing' => 'preserve', 'show_date' => 'modified', 'date_format' => 'Y' ), 0 );
