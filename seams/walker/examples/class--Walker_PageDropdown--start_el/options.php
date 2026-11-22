<?php
// The options of a page dropdown: indented by depth, the selected one marked, list_pages filtering each title.
guide_page( 1, 'About' ); guide_page( 2, 'Team', 1 ); guide_page( 3, 'Contact' );
$pages = array( get_post( 1 ), get_post( 2 ), get_post( 3 ) );
function guide_mark_page_title( $title, $page ) {
	return $title . '!';
}
add_filter( 'list_pages', 'guide_mark_page_title', 10, 2 );
return ( new Walker_PageDropdown() )->walk( $pages, 0, array( 'selected' => 2 ) );
