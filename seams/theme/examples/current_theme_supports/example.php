<?php
// Whether the theme supports a feature, or a sub-feature of it (a post type for post-thumbnails, a type for html5 or post-formats); filtered by current_theme_supports-{$feature}.
add_theme_support( 'post-formats', array( 'aside' ) );
return array( current_theme_supports( 'post-formats' ), current_theme_supports( 'post-formats', 'aside' ), current_theme_supports( 'post-formats', 'video' ) );
