<?php
// Adds support for WordPress's block styles and loads style.css as an editor style; on after_setup_theme.
guide_theme( 'twentytwentytwo' );
return array( current_theme_supports( 'wp-block-styles' ), array_map( 'basename', get_editor_stylesheets() ) );
