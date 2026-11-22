<?php
// Sets up the theme on after_setup_theme: feed links, title tag, every post format, thumbnails 1568 wide, the Primary and Secondary menus, html5, a custom logo, block styles, wide alignment, editor styles (dark when the background is dark), its font sizes, colors and gradients, a custom background, and more editor features; RSS widgets lose their feed link.
guide_theme( 'twentytwentyone' );
return array( get_theme_support( 'post-formats' )[0], get_registered_nav_menus(), wp_list_pluck( get_theme_support( 'editor-font-sizes' )[0], 'size', 'slug' ), get_theme_support( 'custom-background' )[0]['default-color'], current_theme_supports( 'dark-editor-style' ), has_filter( 'rss_widget_feed_link', '__return_empty_string' ) );
