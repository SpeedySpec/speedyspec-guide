<?php
// Adds the CSS coloring the admin menu's SVG icons to the admin-menu stylesheet, when the user's color scheme was added by a plugin.
wp_admin_css_color( 'tea', 'Tea', 'https://example.org/tea-colors.css', array( '#2e4a3f', '#6b8f71', '#c9d6b4', '#f2efe4' ), array( 'base' => '#c9d6b4', 'focus' => '#ffffff', 'current' => '#ffffff' ) );
update_user_option( get_current_user_id(), 'admin_color', 'tea' );
wp_color_scheme_menu_icon_styles();
return str_contains( implode( '', wp_styles()->get_data( 'admin-menu', 'after' ) ?: array() ), '#adminmenu' );
