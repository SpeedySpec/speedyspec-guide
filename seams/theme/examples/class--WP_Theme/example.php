<?php
// WP_Theme reads a theme's style.css headers (Name, Version, Author and the rest) raw, sanitized or marked up for display, with its folders, parent, screenshot, templates, block patterns and errors; cached.
$theme = wp_get_theme( 'twentytwentyone' );
return array( (string) $theme, $theme->get( 'Version' ) !== '', $theme->display( 'Author', false ), $theme->get_stylesheet(), $theme->parent(), $theme->is_block_theme(), basename( $theme->get_screenshot() ), $theme->errors() );
