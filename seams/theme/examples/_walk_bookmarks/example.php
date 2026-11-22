<?php
// Renders links as list items or other markup, with their images, descriptions, ratings and updated times.
$a = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_description' => 'Code is poetry' ) );
$b = wp_insert_link( array( 'link_url' => 'https://php.net', 'link_name' => 'PHP' ) );
return _walk_bookmarks( get_bookmarks(), array( 'show_description' => 1, 'between' => ' - ' ) );
