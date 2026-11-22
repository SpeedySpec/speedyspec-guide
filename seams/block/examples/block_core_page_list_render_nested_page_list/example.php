<?php
// The Page List markup for pages with nested children.
$pages = array( 2 => array( 'page_id' => 2, 'title' => 'About', 'link' => 'http://example.org/about/', 'is_active' => false, 'children' => array( 3 => array( 'page_id' => 3, 'title' => 'Team', 'link' => 'http://example.org/about/team/', 'is_active' => true ) ) ) );
return block_core_page_list_render_nested_page_list( false, false, false, $pages, false );
