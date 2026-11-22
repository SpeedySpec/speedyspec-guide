<?php
// Registers a feature the theme supports (post-thumbnails, html5, custom-logo, align-wide and others), with arguments merged into defaults; must happen before wp_loaded for title-tag. Some features also add their hooks.
add_theme_support( 'html5', array( 'search-form' ) );
add_theme_support( 'html5', array( 'gallery' ) );
add_theme_support( 'post-thumbnails', array( 'post' ) );
return array( get_theme_support( 'html5' )[0], current_theme_supports( 'post-thumbnails', 'page' ), add_theme_support( 'title-tag' ) );
