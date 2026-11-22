<?php
// Sets up the theme on after_setup_theme: feed links, a custom background (f5efe0), thumbnails 1200 wide and a 1980-wide fullscreen size, a custom logo, title tag, html5, block styles, wide alignment, responsive embeds and starter content in the Customizer; $content_width is 580.
guide_theme( 'twentytwenty' );
return array( get_theme_support( 'custom-background' )[0]['default-color'], wp_get_additional_image_sizes()['twentytwenty-fullscreen'] ?? null, current_theme_supports( 'align-wide' ), $GLOBALS['content_width'] );
