<?php
// Prints the nonce for activating the previewed block theme, for the site editor.
$_GET['wp_theme_preview'] = 'twentytwentyfive';
return str_contains( guide_render( 'wp_block_theme_activate_nonce' ), 'WP_BLOCK_THEME_ACTIVATE_NONCE' );
