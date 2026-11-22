<?php
// Whether something names a menu: a nav_menu term by ID, slug or name.
$id = wp_create_nav_menu( 'Main' );
$category = wp_insert_term( 'News', 'category' );
return array( is_nav_menu( $id ), is_nav_menu( 'main' ), is_nav_menu( 'Nope' ), is_nav_menu( 0 ), is_nav_menu( $category['term_id'] ) );
