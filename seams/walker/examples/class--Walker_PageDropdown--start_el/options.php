<?php
// The options of a page dropdown: indented by depth, the selected one marked, list_pages filtering each title.
guide_page( 1, 'About' ); guide_page( 2, 'Team', 1 ); guide_page( 3, 'Contact' );
$pages = array( get_post( 1 ), get_post( 2 ), get_post( 3 ) );
add_filter( 'list_pages', fn( $title, $page ) => $title . '!', 10, 2 );
return ( new Walker_PageDropdown() )->walk( $pages, 0, array( 'selected' => 2 ) );
