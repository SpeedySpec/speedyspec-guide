<?php
// Hooked to plugins_loaded: when a block theme preview is asked for, hooks the stylesheet and template filters, the middleware and the activate nonce.
$_GET['wp_theme_preview'] = 'twentytwentyfive';
wp_initialize_theme_preview_hooks();
return array( has_filter( 'stylesheet', 'wp_get_theme_preview_path' ), has_filter( 'template', 'wp_get_theme_preview_path' ) );
