<?php
// Registers an admin color scheme with its stylesheet and colors.
wp_admin_css_color( 'guide', 'Guide', '/guide.css', array( '#111', '#222', '#333', '#444' ) );
return $GLOBALS['_wp_admin_css_colors']['guide']->name;
