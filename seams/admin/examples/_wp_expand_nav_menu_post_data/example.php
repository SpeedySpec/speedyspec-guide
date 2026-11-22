<?php
// Unpacks the menus screen's form, sent as one JSON field to get past max_input_vars, into $_POST.
$_POST['nav-menu-data'] = wp_json_encode( array( array( 'name' => 'menu-name', 'value' => 'Main' ) ) );
_wp_expand_nav_menu_post_data();
return $_POST['menu-name'];
