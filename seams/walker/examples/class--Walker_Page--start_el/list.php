<?php
// A page list as wp_list_pages() writes it: links, classes for the current page and its ancestors, and children in ul.children.
guide_page( 1, 'About' ); guide_page( 2, 'Team', 1 ); guide_page( 3, 'Contact' );
$pages = array( get_post( 1 ), get_post( 2 ), get_post( 3 ) );
return ( new Walker_Page() )->walk( $pages, 0, array( 'pages_with_children' => array( 1 => true ) ), 2 );
