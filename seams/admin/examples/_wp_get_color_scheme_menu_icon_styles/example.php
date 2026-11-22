<?php
// The CSS that colors the admin menu's SVG icons for a color scheme a plugin added; empty for WordPress's own schemes, whose stylesheets do it.
wp_admin_css_color( 'tea', 'Tea', 'https://example.org/tea-colors.css', array( '#2e4a3f', '#6b8f71', '#c9d6b4', '#f2efe4' ), array( 'base' => '#c9d6b4', 'focus' => '#ffffff', 'current' => '#ffffff' ) );
return array( str_contains( _wp_get_color_scheme_menu_icon_styles( 'tea' ), '#adminmenu' ), _wp_get_color_scheme_menu_icon_styles( 'fresh' ) );
