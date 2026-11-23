<?php
// Hooked to nav_menu_meta_box_object: lets the Pages box list pages without a limit, with the front and posts pages first.
$type = _wp_nav_menu_meta_box_object( get_post_type_object( 'page' ) );
return array( $type->name, $type->_default_query ?? null );
