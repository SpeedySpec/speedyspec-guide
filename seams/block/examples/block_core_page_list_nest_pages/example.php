<?php
// Pages nested under their parents.
$top = array( 2 => array( 'title' => 'About' ) );
$children = array( 2 => array( 3 => array( 'title' => 'Team' ) ) );
return block_core_page_list_nest_pages( $top, $children );
