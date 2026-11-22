<?php
// Hooked to admin_menu: adds the admin menu entries of post types shown under another menu.
register_post_type( 'book', array( 'public' => true, 'show_in_menu' => 'tools.php' ) );
return has_action( 'admin_menu', '_add_post_type_submenus' );
