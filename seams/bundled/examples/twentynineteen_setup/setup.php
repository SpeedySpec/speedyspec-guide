<?php
// Sets up the theme on after_setup_theme: feed links, title tag, thumbnails 1568 wide, the Primary, Footer and Social Links menus, html5, a 190px custom logo, block styles, wide alignment, editor styles with its font sizes and colors (the primary colors from its hue), responsive embeds and custom line height.
guide_theme( 'twentynineteen' );
return array( get_registered_nav_menus(), wp_list_pluck( get_theme_support( 'editor-font-sizes' )[0], 'size', 'slug' ), wp_list_pluck( get_theme_support( 'editor-color-palette' )[0], 'color', 'slug' ), get_theme_support( 'custom-logo' )[0]['width'] );
