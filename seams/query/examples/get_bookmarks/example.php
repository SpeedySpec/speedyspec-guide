<?php
// Visible links by category, name, rating and more, cached; filtered by get_bookmarks.
$link = wp_insert_link( array( 'link_url' => 'https://wordpress.org', 'link_name' => 'WordPress', 'link_rating' => 8 ) );
wp_insert_link( array( 'link_url' => 'https://example.org', 'link_name' => 'Example', 'link_visible' => 'N' ) );

return array( wp_list_pluck( get_bookmarks(), 'link_name' ), wp_list_pluck( get_bookmarks( array( 'hide_invisible' => 0, 'orderby' => 'name' ) ), 'link_name' ) );
