<?php
// Prints (or gives) the links grouped under their categories, or in one list; filtered by wp_list_bookmarks.
$a = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_description' => 'Code is poetry' ) );
$b = wp_insert_link( array( 'link_url' => 'https://php.net', 'link_name' => 'PHP' ) );
return wp_list_bookmarks( array( 'echo' => 0, 'categorize' => 0, 'title_li' => 'Links' ) );
